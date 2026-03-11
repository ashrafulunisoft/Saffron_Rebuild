<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_bn',
        'slug',
        'content_en',
        'content_bn',
        'excerpt_en',
        'excerpt_bn',
        'featured_image',
        'user_id',
        'category',
        'tags',
        'status',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * Get the author of the blog post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Get published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Get draft posts
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope: Get featured posts
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Get posts by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Check if post is published
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }

    /**
     * Check if post is draft
     */
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    /**
     * Get title based on locale
     */
    public function getTitleAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->title_bn)) {
            return $this->title_bn;
        }
        return $this->title_en;
    }

    /**
     * Get content based on locale
     */
    public function getContentAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->content_bn)) {
            return $this->content_bn;
        }
        return $this->content_en;
    }

    /**
     * Get excerpt based on locale
     */
    public function getExcerptAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->excerpt_bn)) {
            return $this->excerpt_bn;
        }
        return $this->excerpt_en ?? $this->content_en;
    }

    /**
     * Get tags as array
     */
    public function getTagsArrayAttribute()
    {
        return $this->tags ? array_map('trim', explode(',', $this->tags)) : [];
    }
}
