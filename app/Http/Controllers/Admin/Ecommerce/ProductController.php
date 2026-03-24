<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Product::with('category', 'tags')
            ->withCount('orderItems');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_bn', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhere('description_bn', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter by featured
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }

        // Filter by stock
        if ($request->has('stock')) {
            if ($request->stock === 'low') {
                $query->where('stock', '<=', 10)->where('stock', '>', 0);
            } elseif ($request->stock === 'out') {
                $query->where('stock', 0);
            }
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(20);

        $categories = Category::active()->orderBy('name_en')->get();

        // Get statistics
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $featuredProducts = Product::where('is_featured', true)->count();
        $lowStock = Product::where('stock', '<=', 10)->where('stock', '>', 0)->count();
        $outOfStock = Product::where('stock', 0)->count();

        return view('admin.ecommerce.products.index', compact(
            'products',
            'categories',
            'totalProducts',
            'activeProducts',
            'featuredProducts',
            'lowStock',
            'outOfStock'
        ));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name_en')->get();
        $tags = Tag::orderBy('name_en')->get();

        return view('admin.ecommerce.products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku',
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'primary_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], [
            'sku.required' => 'SKU is required.',
            'sku.unique' => 'This SKU already exists.',
            'name_en.required' => 'The English name is required.',
            'name_bn.required' => 'The Bengali name is required.',
            'price.required' => 'Price is required.',
            'category_id.required' => 'Please select a category.',
            'primary_image.required' => 'Primary image is required.',
            'primary_image.max' => 'The primary image must not be larger than 5MB.',
            'images.*.max' => 'The images must not be larger than 5MB each.',
        ]);

        // Generate slug from English name
        $slug = Str::slug($request->name_en);
        $originalSlug = $slug;
        $counter = 1;

        // Ensure unique slug
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $product = Product::create([
            'sku' => $request->sku,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'slug' => $slug,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Handle primary image upload
        if ($request->hasFile('primary_image')) {
            $primaryImagePath = $request->file('primary_image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $primaryImagePath,
                'is_primary' => true,
            ]);
        }

        // Handle additional images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'is_primary' => false,
                ]);
            }
        }

        // Attach tags if provided
        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }

        return redirect()
            ->route('admin.ecommerce.products.index')
            ->with('success', 'Product created successfully! পণ্য সফলভাবে তৈরি করা হয়েছে!');
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        $product->load(['category', 'orderItems' => function ($query) {
            $query->latest()->take(10);
        }]);

        // Load approved reviews for display
        $product->load('approvedReviews');

        return view('admin.ecommerce.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->orderBy('name_en')->get();
        $tags = Tag::orderBy('name_en')->get();

        return view('admin.ecommerce.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products')->ignore($product->id),
            ],
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], [
            'sku.required' => 'SKU is required.',
            'sku.unique' => 'This SKU already exists.',
            'name_en.required' => 'The English name is required.',
            'name_bn.required' => 'The Bengali name is required.',
            'price.required' => 'Price is required.',
            'category_id.required' => 'Please select a category.',
            'primary_image.max' => 'The primary image must not be larger than 5MB.',
            'images.*.max' => 'The images must not be larger than 5MB each.',
        ]);

        // Update slug if English name changed
        $slug = $product->slug;
        if ($request->name_en !== $product->name_en) {
            $slug = Str::slug($request->name_en);
            $originalSlug = $slug;
            $counter = 1;

            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        }

        $product->update([
            'sku' => $request->sku,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'slug' => $slug,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_featured' => $request->has('is_featured') ? true : false,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        // Handle primary image upload
        if ($request->hasFile('primary_image')) {
            // Delete old primary image
            $oldPrimaryImage = $product->primaryImage;
            if ($oldPrimaryImage) {
                Storage::disk('public')->delete($oldPrimaryImage->image);
                $oldPrimaryImage->delete();
            }

            $primaryImagePath = $request->file('primary_image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $primaryImagePath,
                'is_primary' => true,
            ]);
        }

        // Handle additional images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'is_primary' => false,
                ]);
            }
        }

        // Sync tags
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        } else {
            $product->tags()->detach();
        }

        return redirect()
            ->route('admin.ecommerce.products.index')
            ->with('success', 'Product updated successfully! পণ্য সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        // Check if product has order items
        if ($product->orderItems()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete product with orders! অর্ডার সহ পণ্য মুছে ফেলা যাবে না!'
            ], 400);
        }

        // Delete product images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully! পণ্য সফলভাবে মুছে ফেলা হয়েছে!'
        ]);
    }

    /**
     * Toggle product featured status.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFeatured(Product $product)
    {
        $product->update([
            'is_featured' => !$product->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $product->is_featured,
            'message' => $product->is_featured
                ? 'Product featured successfully!'
                : 'Product unfeatured successfully!'
        ]);
    }

    /**
     * Toggle product active status.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Product $product)
    {
        $product->update([
            'is_active' => !$product->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => $product->is_active
                ? 'Product activated successfully!'
                : 'Product deactivated successfully!'
        ]);
    }

    /**
     * Search products by name or SKU.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');

        if (empty($search)) {
            return response()->json([]);
        }

        $products = Product::query()
            ->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_bn', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            })
            ->active()
            ->orderBy('name_en')
            ->take(20)
            ->get(['id', 'name_en', 'name_bn', 'sku', 'price']);

        return response()->json($products);
    }
}
