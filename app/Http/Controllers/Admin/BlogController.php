<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => BlogPost::count(),
            'published' => BlogPost::published()->count(),
            'draft' => BlogPost::draft()->count(),
            'featured' => BlogPost::featured()->count(),
        ];

        return view('admin.blog.index', compact('posts', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ['News', 'Tutorial', 'Recipe', 'Story', 'Announcement'];
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log $_FILES for debugging
        if (isset($_FILES['featured_image'])) {
            \Log::info('Upload file check', [
                'name' => $_FILES['featured_image']['name'],
                'type' => $_FILES['featured_image']['type'],
                'size' => $_FILES['featured_image']['size'],
                'tmp_name' => $_FILES['featured_image']['tmp_name'],
                'error' => $_FILES['featured_image']['error'],
                'error_name' => $this->getUploadErrorMessage($_FILES['featured_image']['error']),
                'php_max_upload' => ini_get('upload_max_filesize'),
                'php_max_post' => ini_get('post_max_size'),
            ]);
        }

        // Detect if file was dropped by PHP due to size limits (BEFORE validation)
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_INI_SIZE) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'File upload failed: Your image is too large for PHP upload limit (' . ini_get('upload_max_filesize') . '). Please compress your image or use a smaller file (under 2MB).');
        }

        // Detect if file was dropped by PHP (empty file but browser sent it)
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['size'] === 0 && $_FILES['featured_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'File upload failed: Your image is too large for PHP upload limit (' . ini_get('upload_max_filesize') . '). Please compress your image or use a smaller file (under 2MB).');
        }

        try {
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_bn' => 'required|string|max:255',
                'content_en' => 'required|string',
                'content_bn' => 'required|string',
                'excerpt_en' => 'nullable|string',
                'excerpt_bn' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'category' => 'nullable|string|max:100',
                'tags' => 'nullable|string|max:500',
                'status' => 'required|in:draft,published',
                'is_featured' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:500',
            ]);

            // Generate unique slug
            $slug = Str::slug($validated['title_en']);
            $originalSlug = $slug;
            $counter = 1;

            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            \Log::info('Slug generated', ['slug' => $slug]);

            // Handle featured image upload
            $featuredImagePath = null;
            if ($request->hasFile('featured_image')) {
                \Log::info('File detected, starting upload process');

                $file = $request->file('featured_image');

                \Log::info('File object created', [
                    'file_exists' => $file !== null,
                    'is_valid' => $file->isValid(),
                    'error_code' => $file->getError(),
                    'error_message' => $file->getErrorMessage(),
                    'client_original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'path' => $file->getPathname(),
                ]);

                // Check if file is valid
                if (!$file->isValid()) {
                    $errorMsg = 'File upload failed. Error code: ' . $file->getError() . ' - ' . $file->getErrorMessage();
                    \Log::error('File validation failed', [
                        'error_code' => $file->getError(),
                        'error_message' => $file->getErrorMessage(),
                    ]);
                    throw new \Exception($errorMsg);
                }

                // Check file size
                $fileSize = $file->getSize();
                $maxSize = 5 * 1024 * 1024; // 5MB in bytes

                \Log::info('Checking file size', [
                    'file_size' => $fileSize,
                    'max_size' => $maxSize,
                    'file_size_mb' => round($fileSize / 1024 / 1024, 2),
                ]);

                if ($fileSize > $maxSize) {
                    $errorMsg = "File size is too large ({$this->formatBytes($fileSize)}). Maximum allowed size is 5MB.";
                    \Log::error('File size exceeded', [
                        'file_size' => $fileSize,
                        'max_size' => $maxSize,
                    ]);
                    throw new \Exception($errorMsg);
                }

                \Log::info('Starting file store to storage/app/public/blog');

                // Generate unique filename: timestamp + random string + original extension
                $extension = $file->getClientOriginalExtension();
                $uniqueName = 'blog_' . time() . '_' . Str::random(10) . '.' . $extension;
                $featuredImagePath = $file->storeAs('blog', $uniqueName, 'public');

                \Log::info('File store completed', [
                    'path' => $featuredImagePath,
                    'unique_name' => $uniqueName,
                    'is_null' => $featuredImagePath === null,
                    'is_empty' => $featuredImagePath === '',
                ]);

                if (!$featuredImagePath) {
                    \Log::error('File store returned null/false');
                    throw new \Exception('Failed to save the uploaded image.');
                }

                // Verify file was actually saved
                $fullPath = storage_path('app/public/' . $featuredImagePath);
                \Log::info('Checking if file exists on disk', [
                    'full_path' => $fullPath,
                    'file_exists' => file_exists($fullPath),
                    'is_readable' => is_readable($fullPath),
                    'file_size' => file_exists($fullPath) ? filesize($fullPath) : 'N/A',
                ]);

                if (!file_exists($fullPath)) {
                    \Log::error('File does not exist on disk after store', [
                        'path' => $featuredImagePath,
                        'full_path' => $fullPath,
                    ]);
                }
            } else {
                \Log::info('No file in request');
            }

            \Log::info('Creating blog post');

            $post = BlogPost::create([
                'title_en' => $validated['title_en'],
                'title_bn' => $validated['title_bn'],
                'slug' => $slug,
                'content_en' => $validated['content_en'],
                'content_bn' => $validated['content_bn'],
                'excerpt_en' => $validated['excerpt_en'] ?? Str::limit(strip_tags($validated['content_en']), 150),
                'excerpt_bn' => $validated['excerpt_bn'] ?? Str::limit(strip_tags($validated['content_bn']), 150),
                'featured_image' => $featuredImagePath,
                'user_id' => auth()->id(),
                'category' => $validated['category'] ?? null,
                'tags' => $validated['tags'] ?? null,
                'status' => $validated['status'],
                'is_featured' => $request->has('is_featured') ? true : false,
                'meta_title' => $validated['meta_title'] ?? $validated['title_en'],
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'published_at' => $validated['status'] === 'published' ? now() : null,
            ]);

            \Log::info('Blog post created successfully', ['post_id' => $post->id]);
            \Log::info('=== BLOG STORE END ===');

            return redirect()
                ->route('admin.ecommerce.blog.index')
                ->with('success', 'Blog post created successfully! ব্লগ পোস্ট সফলভাবে তৈরি করা হয়েছে!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', [
                'errors' => $e->errors(),
                'message' => $e->getMessage(),
            ]);
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            \Log::error('Exception in blog store', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blog)
    {
        $blog->load('user');
        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog)
    {
        $categories = ['News', 'Tutorial', 'Recipe', 'Story', 'Announcement'];
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog)
    {
        // Detect if file was dropped by PHP due to size limits (BEFORE validation)
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_INI_SIZE) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'File upload failed: Your image is too large for PHP upload limit (' . ini_get('upload_max_filesize') . '). Please compress your image or use a smaller file (under 2MB).');
        }

        // Detect if file was dropped by PHP (empty file but browser sent it)
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['size'] === 0 && $_FILES['featured_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'File upload failed: Your image is too large for PHP upload limit (' . ini_get('upload_max_filesize') . '). Please compress your image or use a smaller file (under 2MB).');
        }

        try {
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_bn' => 'required|string|max:255',
                'content_en' => 'required|string',
                'content_bn' => 'required|string',
                'excerpt_en' => 'nullable|string',
                'excerpt_bn' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'category' => 'nullable|string|max:100',
                'tags' => 'nullable|string|max:500',
                'status' => 'required|in:draft,published,archived',
                'is_featured' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:500',
            ]);

            // Generate unique slug if title changed
            if ($blog->title_en !== $validated['title_en']) {
                $slug = Str::slug($validated['title_en']);
                $originalSlug = $slug;
                $counter = 1;

                while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }
                $blog->slug = $slug;
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');

                // Check if file is valid
                if (!$file->isValid()) {
                    throw new \Exception('File upload failed. Error code: ' . $file->getError());
                }

                // Check file size
                $fileSize = $file->getSize();
                $maxSize = 2 * 1024 * 1024; // 2MB in bytes

                if ($fileSize > $maxSize) {
                    throw new \Exception("File size is too large ({$this->formatBytes($fileSize)}). Maximum allowed size is 2MB.");
                }

                // Delete old image
                if ($blog->featured_image) {
                    Storage::disk('public')->delete($blog->featured_image);
                }

                // Generate unique filename: timestamp + random string + original extension
                $extension = $file->getClientOriginalExtension();
                $uniqueName = 'blog_' . time() . '_' . Str::random(10) . '.' . $extension;
                $imagePath = $file->storeAs('blog', $uniqueName, 'public');

                if (!$imagePath) {
                    throw new \Exception('Failed to save the uploaded image.');
                }

                $blog->featured_image = $imagePath;
            }

            $blog->title_en = $validated['title_en'];
            $blog->title_bn = $validated['title_bn'];
            $blog->content_en = $validated['content_en'];
            $blog->content_bn = $validated['content_bn'];
            $blog->excerpt_en = $validated['excerpt_en'] ?? Str::limit(strip_tags($validated['content_en']), 150);
            $blog->excerpt_bn = $validated['excerpt_bn'] ?? Str::limit(strip_tags($validated['content_bn']), 150);
            $blog->category = $validated['category'] ?? null;
            $blog->tags = $validated['tags'] ?? null;
            $blog->status = $validated['status'];
            $blog->is_featured = $request->has('is_featured') ? true : false;
            $blog->meta_title = $validated['meta_title'] ?? $validated['title_en'];
            $blog->meta_description = $validated['meta_description'] ?? null;
            $blog->meta_keywords = $validated['meta_keywords'] ?? null;

            // Update published_at if status changed to published
            if ($validated['status'] === 'published' && !$blog->published_at) {
                $blog->published_at = now();
            }

            $blog->save();

            return redirect()
                ->route('admin.ecommerce.blog.index')
                ->with('success', 'Blog post updated successfully! ব্লগ পোস্ট সফলভাবে আপডেট করা হয়েছে!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog post deleted successfully! ব্লগ পোস্ট সফলভাবে মুছে ফেলা হয়েছে!'
        ]);
    }

    /**
     * Toggle post status (draft/published)
     */
    public function toggleStatus(BlogPost $blog)
    {
        $newStatus = $blog->status === 'published' ? 'draft' : 'published';
        $blog->status = $newStatus;

        if ($newStatus === 'published' && !$blog->published_at) {
            $blog->published_at = now();
        }

        $blog->save();

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => $newStatus === 'published'
                ? 'Post published successfully! পোস্ট সফলভাবে প্রকাশিত হয়েছে!'
                : 'Post set to draft! পোস্ট ড্রাফ্ট করা হয়েছে!'
        ]);
    }

    /**
     * Format bytes to human readable size
     */
    private function formatBytes($size, $precision = 2): string
    {
        if ($size == 0) return '0 B';

        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    /**
     * Get upload error message from error code
     */
    private function getUploadErrorMessage($errorCode): string
    {
        $errors = [
            UPLOAD_ERR_OK => 'No error',
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'PHP extension stopped the file upload',
        ];

        return $errors[$errorCode] ?? "Unknown error (code: {$errorCode})";
    }
}
