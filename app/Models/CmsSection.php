<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cms_page_id',
        'section_key',
        'title_en',
        'title_bn',
        'subtitle_en',
        'subtitle_bn',
        'content_en',
        'content_bn',
        'button_text_en',
        'button_text_bn',
        'button_url',
        'image_url',
        'icon',
        'sort_order',
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
     * Scope to get only active sections.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the CMS page that owns the section.
     */
    public function cmsPage()
    {
        return $this->belongsTo(CmsPage::class);
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
     * Get subtitle based on locale.
     */
    public function getSubtitleAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->attributes['subtitle_bn'])) {
            return $this->attributes['subtitle_bn'];
        }
        return $this->attributes['subtitle_en'];
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

    /**
     * Get button text based on locale.
     */
    public function getButtonTextAttribute()
    {
        if (app()->getLocale() === 'bn' && !empty($this->attributes['button_text_bn'])) {
            return $this->attributes['button_text_bn'];
        }
        return $this->attributes['button_text_en'];
    }
}
