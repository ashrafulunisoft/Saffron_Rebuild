<?php

namespace App\Helpers;

use App\Models\CmsPage;

class CmsHelper
{
    /**
     * Get CMS page content by slug with fallback to default content.
     *
     * @param string $slug
     * @param array $defaults
     * @return object
     */
    public static function getPage(string $slug, array $defaults = [])
    {
        $page = CmsPage::active()->where('slug', $slug)->first();

        return (object) [
            'title' => $page ? $page->title : ($defaults['title'] ?? 'Page'),
            'excerpt' => $page ? $page->excerpt : ($defaults['excerpt'] ?? null),
            'content' => $page ? $page->content : ($defaults['content'] ?? ''),
            'meta_title' => $page ? $page->meta_title : ($defaults['meta_title'] ?? null),
            'meta_description' => $page ? $page->meta_description : ($defaults['meta_description'] ?? null),
            'meta_keywords' => $page ? $page->meta_keywords : ($defaults['meta_keywords'] ?? null),
            'has_custom_content' => $page !== null,
        ];
    }

    /**
     * Check if a page has custom CMS content.
     *
     * @param string $slug
     * @return bool
     */
    public static function hasCustomContent(string $slug): bool
    {
        return CmsPage::active()->where('slug', $slug)->exists();
    }

    /**
     * Get page title with fallback.
     *
     * @param string $slug
     * @param string $default
     * @return string
     */
    public static function getTitle(string $slug, string $default = 'Page'): string
    {
        $page = CmsPage::active()->where('slug', $slug)->first();
        return $page ? $page->title : $default;
    }

    /**
     * Get page content with fallback.
     *
     * @param string $slug
     * @param string $default
     * @return string
     */
    public static function getContent(string $slug, string $default = ''): string
    {
        $page = CmsPage::active()->where('slug', $slug)->first();
        return $page ? $page->content : $default;
    }
}
