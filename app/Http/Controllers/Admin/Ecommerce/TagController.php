<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of tags.
     */
    public function index()
    {
        $tags = Tag::withCount('products')
            ->orderBy('name_en')
            ->paginate(20);

        return view('admin.ecommerce.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     */
    public function create()
    {
        return view('admin.ecommerce.tags.create');
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:tags,name_en',
            'name_bn' => 'required|string|max:255|unique:tags,name_bn',
        ], [
            'name_en.required' => 'The English name is required.',
            'name_en.unique' => 'A tag with this English name already exists.',
            'name_bn.required' => 'The Bengali name is required.',
            'name_bn.unique' => 'A tag with this Bengali name already exists.',
        ]);

        Tag::create([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
        ]);

        return redirect()
            ->route('admin.ecommerce.tags.index')
            ->with('success', 'Tag created successfully! ট্যাগ সফলভাবে তৈরি করা হয়েছে!');
    }

    /**
     * Display the specified tag.
     */
    public function show(Tag $tag)
    {
        $tag->load('products');

        return view('admin.ecommerce.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified tag.
     */
    public function edit(Tag $tag)
    {
        return view('admin.ecommerce.tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name_en' => 'required|string|max:255|unique:tags,name_en,' . $tag->id,
            'name_bn' => 'required|string|max:255|unique:tags,name_bn,' . $tag->id,
        ], [
            'name_en.required' => 'The English name is required.',
            'name_en.unique' => 'A tag with this English name already exists.',
            'name_bn.required' => 'The Bengali name is required.',
            'name_bn.unique' => 'A tag with this Bengali name already exists.',
        ]);

        $tag->update([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
        ]);

        return redirect()
            ->route('admin.ecommerce.tags.index')
            ->with('success', 'Tag updated successfully! ট্যাগ সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy(Tag $tag)
    {
        // Check if tag is being used by products
        if ($tag->products()->count() > 0) {
            return back()->with('error', 'Cannot delete tag! It is being used by ' . $tag->products()->count() . ' product(s).');
        }

        $tag->delete();

        return redirect()
            ->route('admin.ecommerce.tags.index')
            ->with('success', 'Tag deleted successfully! ট্যাগ সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Search tags.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $tags = Tag::where('name_en', 'like', "%{$query}%")
            ->orWhere('name_bn', 'like', "%{$query}%")
            ->withCount('products')
            ->orderBy('name_en')
            ->paginate(20);

        return view('admin.ecommerce.tags.index', compact('tags', 'query'));
    }
}
