<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of CMS pages.
     */
    public function index()
    {
        $pages = CmsPage::latest()->paginate(10);
        return view('admin.cms.index', compact('pages'));
    }

    /**
     * Show the form for creating a new CMS page.
     */
    public function create()
    {
        return view('admin.cms.create');
    }

    /**
     * Store a newly created CMS page.
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:cms_pages,slug',
            'title_en' => 'required|string|max:255',
            'excerpt_en' => 'nullable|string',
            'content_en' => 'nullable|string',
            'title_bn' => 'nullable|string|max:255',
            'excerpt_bn' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        CmsPage::create([
            'slug' => $request->slug,
            'title_en' => $request->title_en,
            'excerpt_en' => $request->excerpt_en,
            'content_en' => $request->content_en,
            'title_bn' => $request->title_bn,
            'excerpt_bn' => $request->excerpt_bn,
            'content_bn' => $request->content_bn,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.cms.index')
            ->with('success', 'CMS page created successfully!');
    }

    /**
     * Show the form for editing the specified CMS page.
     */
    public function edit(CmsPage $cms)
    {
        return view('admin.cms.edit', compact('cms'));
    }

    /**
     * Update the specified CMS page.
     */
    public function update(Request $request, CmsPage $cms)
    {
        $request->validate([
            'slug' => 'required|unique:cms_pages,slug,' . $cms->id,
            'title_en' => 'required|string|max:255',
            'excerpt_en' => 'nullable|string',
            'content_en' => 'nullable|string',
            'title_bn' => 'nullable|string|max:255',
            'excerpt_bn' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $cms->update([
            'slug' => $request->slug,
            'title_en' => $request->title_en,
            'excerpt_en' => $request->excerpt_en,
            'content_en' => $request->content_en,
            'title_bn' => $request->title_bn,
            'excerpt_bn' => $request->excerpt_bn,
            'content_bn' => $request->content_bn,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.cms.index')
            ->with('success', 'CMS page updated successfully!');
    }

    /**
     * Remove the specified CMS page.
     */
    public function destroy(CmsPage $cms)
    {
        $cms->delete();

        return redirect()->route('admin.cms.index')
            ->with('success', 'CMS page deleted successfully!');
    }
}
