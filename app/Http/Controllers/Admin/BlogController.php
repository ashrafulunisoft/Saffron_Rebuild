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
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_bn' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_bn' => 'required|string',
            'excerpt_en' => 'nullable|string',
            'excerpt_bn' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('blog', 'public');
        }

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

        return redirect()
            ->route('admin.ecommerce.blog.index')
            ->with('success', 'Blog post created successfully! ব্লগ পোস্ট সফলভাবে তৈরি করা হয়েছে!');
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
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_bn' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_bn' => 'required|string',
            'excerpt_en' => 'nullable|string',
            'excerpt_bn' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $blog->featured_image = $request->file('featured_image')->store('blog', 'public');
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
            ->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully! ব্লগ পোস্ট সফলভাবে আপডেট করা হয়েছে!');
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

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully! ব্লগ পোস্ট সফলভাবে মুছে ফেলা হয়েছে!');
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
}
