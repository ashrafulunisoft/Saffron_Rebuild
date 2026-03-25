<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\CmsSection;
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

        return redirect()->route('admin.ecommerce.cms.index')
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

        return redirect()->route('admin.ecommerce.cms.index')
            ->with('success', 'CMS page updated successfully!');
    }

    /**
     * Remove the specified CMS page.
     */
    public function destroy(CmsPage $cms)
    {
        $cms->delete();

        return redirect()->route('admin.ecommerce.cms.index')
            ->with('success', 'CMS page deleted successfully!');
    }

    /**
     * Show sections for a CMS page.
     */
    public function sections(CmsPage $cms)
    {
        return view('admin.cms.sections', compact('cms'));
    }

    /**
     * Show form to create a new section.
     */
    public function createSection(CmsPage $cms)
    {
        return view('admin.cms.create-section', compact('cms'));
    }

    /**
     * Store a new section.
     */
    public function storeSection(Request $request, CmsPage $cms)
    {
        $request->validate([
            'section_key' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string',
            'subtitle_bn' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'button_text_en' => 'nullable|string',
            'button_text_bn' => 'nullable|string',
            'button_url' => 'nullable|string',
            'image_url' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $cms->sections()->create([
            'section_key' => $request->section_key,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_bn' => $request->subtitle_bn,
            'content_en' => $request->content_en,
            'content_bn' => $request->content_bn,
            'button_text_en' => $request->button_text_en,
            'button_text_bn' => $request->button_text_bn,
            'button_url' => $request->button_url,
            'image_url' => $request->image_url,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.ecommerce.cms.sections', $cms)
            ->with('success', 'Section created successfully!');
    }

    /**
     * Show form to edit a section.
     */
    public function editSection(CmsPage $cms, CmsSection $section)
    {
        return view('admin.cms.edit-section', compact('cms', 'section'));
    }

    /**
     * Update a section.
     */
    public function updateSection(Request $request, CmsPage $cms, CmsSection $section)
    {
        $request->validate([
            'section_key' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'subtitle_en' => 'nullable|string',
            'subtitle_bn' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_bn' => 'nullable|string',
            'button_text_en' => 'nullable|string',
            'button_text_bn' => 'nullable|string',
            'button_url' => 'nullable|string',
            'image_url' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $section->update([
            'section_key' => $request->section_key,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_bn' => $request->subtitle_bn,
            'content_en' => $request->content_en,
            'content_bn' => $request->content_bn,
            'button_text_en' => $request->button_text_en,
            'button_text_bn' => $request->button_text_bn,
            'button_url' => $request->button_url,
            'image_url' => $request->image_url,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.ecommerce.cms.sections', $cms)
            ->with('success', 'Section updated successfully!');
    }

    /**
     * Delete a section.
     */
    public function destroySection(CmsPage $cms, CmsSection $section)
    {
        $section->delete();

        return redirect()->route('admin.ecommerce.cms.sections', $cms)
            ->with('success', 'Section deleted successfully!');
    }
}
