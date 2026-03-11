<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('products')
            ->with('parent')
            ->orderBy('name_en')
            ->paginate(20);

        $parentCategories = Category::whereNull('parent_id')
            ->active()
            ->get();

        // Statistics for the view
        $totalCategories = Category::count();
        $activeCategories = Category::where('is_active', true)->count();
        $rootCategories = Category::whereNull('parent_id')->count();
        $categoriesWithProducts = Category::has('products')->count();

        return view('admin.ecommerce.categories.index', compact(
            'categories',
            'parentCategories',
            'totalCategories',
            'activeCategories',
            'rootCategories',
            'categoriesWithProducts'
        ));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
            ->active()
            ->orderBy('name_en')
            ->get();

        return view('admin.ecommerce.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:categories,name_en',
            'name_bn' => 'required|string|max:255|unique:categories,name_bn',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'nullable|boolean',
        ], [
            'name_en.required' => 'The English name is required.',
            'name_en.unique' => 'This English name already exists.',
            'name_bn.required' => 'The Bengali name is required.',
            'name_bn.unique' => 'This Bengali name already exists.',
            'parent_id.exists' => 'The selected parent category is invalid.',
        ]);

        // Generate slug from English name
        $slug = Str::slug($request->name_en);
        $originalSlug = $slug;
        $counter = 1;

        // Ensure unique slug
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Category::create([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'slug' => $slug,
            'parent_id' => $request->parent_id ?: null,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()
            ->route('admin.ecommerce.categories.index')
            ->with('success', 'Category created successfully! ক্যাটাগরি সফলভাবে তৈরি করা হয়েছে!');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        $category->load(['parent', 'children', 'products' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.ecommerce.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id) // Exclude self and descendants
            ->active()
            ->orderBy('name_en')
            ->get();

        return view('admin.ecommerce.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'name_bn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($category) {
                    // Prevent setting self as parent
                    if ($value == $category->id) {
                        $fail('A category cannot be its own parent.');
                    }
                    // Prevent creating circular references
                    if ($value && $this->isCircularReference($category->id, $value)) {
                        $fail('This would create a circular reference in the category hierarchy.');
                    }
                },
            ],
            'is_active' => 'nullable|boolean',
        ], [
            'name_en.required' => 'The English name is required.',
            'name_en.unique' => 'This English name already exists.',
            'name_bn.required' => 'The Bengali name is required.',
            'name_bn.unique' => 'This Bengali name already exists.',
            'parent_id.exists' => 'The selected parent category is invalid.',
        ]);

        // Update slug if English name changed
        $slug = $category->slug;
        if ($request->name_en !== $category->name_en) {
            $slug = Str::slug($request->name_en);
            $originalSlug = $slug;
            $counter = 1;

            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        }

        $category->update([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'slug' => $slug,
            'parent_id' => $request->parent_id ?: null,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()
            ->route('admin.ecommerce.categories.index')
            ->with('success', 'Category updated successfully! ক্যাটাগরি সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()
                ->route('admin.ecommerce.categories.index')
                ->with('error', 'Cannot delete category with products! পণ্য সহ ক্যাটাগরি মুছে ফেলা যাবে না!');
        }

        // Check if category has children
        if ($category->children()->count() > 0) {
            return redirect()
                ->route('admin.ecommerce.categories.index')
                ->with('error', 'Cannot delete category with subcategories! সাবক্যাটাগরি সহ ক্যাটাগরি মুছে ফেলা যাবে না!');
        }

        $category->delete();

        return redirect()
            ->route('admin.ecommerce.categories.index')
            ->with('success', 'Category deleted successfully! ক্যাটাগরি সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Toggle category active status.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Category $category)
    {
        $category->update([
            'is_active' => !$category->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $category->is_active,
            'message' => $category->is_active
                ? 'Category activated successfully!'
                : 'Category deactivated successfully!'
        ]);
    }

    /**
     * Search categories by name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');

        $categories = Category::query()
            ->where('name_en', 'like', "%{$search}%")
            ->orWhere('name_bn', 'like', "%{$search}%")
            ->active()
            ->orderBy('name_en')
            ->take(20)
            ->get(['id', 'name_en', 'name_bn', 'slug']);

        return response()->json($categories);
    }

    /**
     * Check if the parent assignment would create a circular reference.
     *
     * @param  int  $categoryId
     * @param  int  $potentialParentId
     * @return bool
     */
    private function isCircularReference($categoryId, $potentialParentId)
    {
        $current = Category::find($potentialParentId);

        while ($current && $current->parent_id) {
            if ($current->parent_id == $categoryId) {
                return true;
            }
            $current = $current->parent;
        }

        return false;
    }
}
