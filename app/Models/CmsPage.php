<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title_en',
        'excerpt_en',
        'content_en',
        'title_bn',
        'excerpt_bn',
        'content_bn',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope to get only active pages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the sections for the CMS page.
     */
    public function sections()
    {
        return $this->hasMany(CmsSection::class)->orderBy('sort_order');
    }

    /**
     * Get title based on locale.
     */
    public function getTitleAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->attributes['title_bn'])) {
            return $this->attributes['title_bn'];
        }
        return $this->attributes['title_en'];
    }

    /**
     * Get excerpt based on locale.
     */
    public function getExcerptAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->attributes['excerpt_bn'])) {
            return $this->attributes['excerpt_bn'];
        }
        return $this->attributes['excerpt_en'];
    }

    /**
     * Get content based on locale.
     */
    public function getContentAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->attributes['content_bn'])) {
            return $this->attributes['content_bn'];
        }
        return $this->attributes['content_en'];
    }
}
