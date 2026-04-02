<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
        'theme_preset',
        'primary_color',
        'primary_color_light',
        'primary_color_dark',
        'secondary_color',
        'secondary_color_dark',
        'accent_color',
        'bg_gradient_1',
        'bg_gradient_2',
        'bg_gradient_3',
        'bg_gradient_4',
        'bg_gradient_5',
        'btn_gradient_start',
        'btn_gradient_end',
        'menu_hover_start',
        'menu_hover_end',
        'text_primary',
        'text_secondary',
        'glass_bg',
        'glass_border',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Predefined theme presets
     */
    const THEME_PRESETS = [
        'default' => [
            'name' => 'Default Amber',
            'description' => 'Warm amber and coral tones',
            'preview' => 'linear-gradient(135deg, #f59e0b, #f43f5e)',
            'colors' => [
                'primary_color' => '#f59e0b',
                'primary_color_light' => '#fbbf24',
                'primary_color_dark' => '#d97706',
                'secondary_color' => '#f43f5e',
                'secondary_color_dark' => '#e11d48',
                'accent_color' => '#8b5cf6',
                'bg_gradient_1' => '#0f0a00',
                'bg_gradient_2' => '#1a0a00',
                'bg_gradient_3' => '#0d0520',
                'bg_gradient_4' => '#001a0d',
                'bg_gradient_5' => '#0f0502',
                'btn_gradient_start' => '#f59e0b',
                'btn_gradient_end' => '#f43f5e',
                'menu_hover_start' => '#f59e0b',
                'menu_hover_end' => '#f43f5e',
                'text_primary' => '#f5e6cc',
                'text_secondary' => '#fbbf24',
                'glass_bg' => 'rgba(255,255,255,0.08)',
                'glass_border' => 'rgba(255,255,255,0.15)',
            ],
        ],
        'gradient_green' => [
            'name' => 'Gradient Green',
            'description' => 'Fresh emerald and teal gradients',
            'preview' => 'linear-gradient(135deg, #10b981, #06b6d4)',
            'colors' => [
                'primary_color' => '#10b981',
                'primary_color_light' => '#34d399',
                'primary_color_dark' => '#059669',
                'secondary_color' => '#06b6d4',
                'secondary_color_dark' => '#0891b2',
                'accent_color' => '#22d3ee',
                'bg_gradient_1' => '#001a0d',
                'bg_gradient_2' => '#0a1f1a',
                'bg_gradient_3' => '#001a1a',
                'bg_gradient_4' => '#0d001a',
                'bg_gradient_5' => '#051a10',
                'btn_gradient_start' => '#10b981',
                'btn_gradient_end' => '#06b6d4',
                'menu_hover_start' => '#10b981',
                'menu_hover_end' => '#06b6d4',
                'text_primary' => '#e6fff0',
                'text_secondary' => '#34d399',
                'glass_bg' => 'rgba(16,185,129,0.08)',
                'glass_border' => 'rgba(16,185,129,0.2)',
            ],
        ],
        'royal_blue' => [
            'name' => 'Royal Blue',
            'description' => 'Elegant blue and indigo tones',
            'preview' => 'linear-gradient(135deg, #3b82f6, #6366f1)',
            'colors' => [
                'primary_color' => '#3b82f6',
                'primary_color_light' => '#60a5fa',
                'primary_color_dark' => '#2563eb',
                'secondary_color' => '#6366f1',
                'secondary_color_dark' => '#4f46e5',
                'accent_color' => '#8b5cf6',
                'bg_gradient_1' => '#0a0a1f',
                'bg_gradient_2' => '#0f0a2a',
                'bg_gradient_3' => '#1a0a3a',
                'bg_gradient_4' => '#0a1a2f',
                'bg_gradient_5' => '#050a1a',
                'btn_gradient_start' => '#3b82f6',
                'btn_gradient_end' => '#6366f1',
                'menu_hover_start' => '#3b82f6',
                'menu_hover_end' => '#6366f1',
                'text_primary' => '#e6f0ff',
                'text_secondary' => '#60a5fa',
                'glass_bg' => 'rgba(59,130,246,0.08)',
                'glass_border' => 'rgba(59,130,246,0.2)',
            ],
        ],
        'royal_gold' => [
            'name' => 'Royal Gold',
            'description' => 'Luxurious gold and bronze tones',
            'preview' => 'linear-gradient(135deg, #d4af37, #b8860b)',
            'colors' => [
                'primary_color' => '#d4af37',
                'primary_color_light' => '#f0d060',
                'primary_color_dark' => '#b8860b',
                'secondary_color' => '#cd853f',
                'secondary_color_dark' => '#a0522d',
                'accent_color' => '#daa520',
                'bg_gradient_1' => '#1a1400',
                'bg_gradient_2' => '#2a1f05',
                'bg_gradient_3' => '#1f1a05',
                'bg_gradient_4' => '#0f1a1a',
                'bg_gradient_5' => '#1a0f05',
                'btn_gradient_start' => '#d4af37',
                'btn_gradient_end' => '#cd853f',
                'menu_hover_start' => '#d4af37',
                'menu_hover_end' => '#cd853f',
                'text_primary' => '#fff5e6',
                'text_secondary' => '#f0d060',
                'glass_bg' => 'rgba(212,175,55,0.08)',
                'glass_border' => 'rgba(212,175,55,0.2)',
            ],
        ],
        'purple_haze' => [
            'name' => 'Purple Haze',
            'description' => 'Rich purple and magenta gradients',
            'preview' => 'linear-gradient(135deg, #8b5cf6, #d946ef)',
            'colors' => [
                'primary_color' => '#8b5cf6',
                'primary_color_light' => '#a78bfa',
                'primary_color_dark' => '#7c3aed',
                'secondary_color' => '#d946ef',
                'secondary_color_dark' => '#c026d3',
                'accent_color' => '#f472b6',
                'bg_gradient_1' => '#150a20',
                'bg_gradient_2' => '#1a0a2a',
                'bg_gradient_3' => '#200a20',
                'bg_gradient_4' => '#0a1520',
                'bg_gradient_5' => '#100515',
                'btn_gradient_start' => '#8b5cf6',
                'btn_gradient_end' => '#d946ef',
                'menu_hover_start' => '#8b5cf6',
                'menu_hover_end' => '#d946ef',
                'text_primary' => '#f5e6ff',
                'text_secondary' => '#a78bfa',
                'glass_bg' => 'rgba(139,92,246,0.08)',
                'glass_border' => 'rgba(139,92,246,0.2)',
            ],
        ],
        'sunset_orange' => [
            'name' => 'Sunset Orange',
            'description' => 'Vibrant orange and pink sunset',
            'preview' => 'linear-gradient(135deg, #f97316, #ec4899)',
            'colors' => [
                'primary_color' => '#f97316',
                'primary_color_light' => '#fb923c',
                'primary_color_dark' => '#ea580c',
                'secondary_color' => '#ec4899',
                'secondary_color_dark' => '#db2777',
                'accent_color' => '#f472b6',
                'bg_gradient_1' => '#1a0a00',
                'bg_gradient_2' => '#200f05',
                'bg_gradient_3' => '#1a0a15',
                'bg_gradient_4' => '#0a1015',
                'bg_gradient_5' => '#150505',
                'btn_gradient_start' => '#f97316',
                'btn_gradient_end' => '#ec4899',
                'menu_hover_start' => '#f97316',
                'menu_hover_end' => '#ec4899',
                'text_primary' => '#fff0e6',
                'text_secondary' => '#fb923c',
                'glass_bg' => 'rgba(249,115,22,0.08)',
                'glass_border' => 'rgba(249,115,22,0.2)',
            ],
        ],
    ];

    /**
     * Get the active theme settings
     */
    public static function getActive()
    {
        $theme = self::where('is_active', true)->first();

        if (!$theme) {
            // Return default theme if no active theme exists
            $theme = self::createDefaultTheme();
        }

        return $theme;
    }

    /**
     * Get active theme (alias for getActive)
     */
    public static function getActiveTheme()
    {
        return self::getActive();
    }

    /**
     * Create default theme if none exists
     */
    public static function createDefaultTheme()
    {
        return self::create([
            'primary_color' => '#f59e0b',
            'primary_color_light' => '#fbbf24',
            'primary_color_dark' => '#d97706',
            'secondary_color' => '#f43f5e',
            'secondary_color_dark' => '#e11d48',
            'accent_color' => '#8b5cf6',
            'bg_gradient_1' => '#0f0a00',
            'bg_gradient_2' => '#1a0a00',
            'bg_gradient_3' => '#0d0520',
            'bg_gradient_4' => '#001a0d',
            'bg_gradient_5' => '#0f0502',
            'btn_gradient_start' => '#f59e0b',
            'btn_gradient_end' => '#f43f5e',
            'menu_hover_start' => '#f59e0b',
            'menu_hover_end' => '#f43f5e',
            'text_primary' => '#f5e6cc',
            'text_secondary' => '#fbbf24',
            'glass_bg' => 'rgba(255,255,255,0.08)',
            'glass_border' => 'rgba(255,255,255,0.15)',
            'is_active' => true,
        ]);
    }

    /**
     * Convert hex color to RGB
     */
    public static function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return ['r' => $r, 'g' => $g, 'b' => $b];
    }

    /**
     * Convert hex color to RGBA string
     */
    public static function hexToRgba($hex, $alpha = 1)
    {
        $rgb = self::hexToRgb($hex);
        return "rgba({$rgb['r']}, {$rgb['g']}, {$rgb['b']}, {$alpha})";
    }

    /**
     * Get theme as CSS variables
     */
    public function toCssVariables()
    {
        return [
            '--theme-primary' => $this->primary_color,
            '--theme-primary-light' => $this->primary_color_light,
            '--theme-primary-dark' => $this->primary_color_dark,
            '--theme-secondary' => $this->secondary_color,
            '--theme-secondary-dark' => $this->secondary_color_dark,
            '--theme-accent' => $this->accent_color,
            '--theme-text-primary' => $this->text_primary,
            '--theme-text-secondary' => $this->text_secondary,
            '--theme-bg-gradient' => "linear-gradient(135deg, {$this->bg_gradient_1} 0%, {$this->bg_gradient_2} 20%, {$this->bg_gradient_3} 40%, {$this->bg_gradient_4} 60%, {$this->bg_gradient_2} 80%, {$this->bg_gradient_5} 100%)",
            '--theme-btn-gradient' => "linear-gradient(135deg, {$this->btn_gradient_start}, {$this->btn_gradient_end})",
            '--theme-menu-hover' => "linear-gradient(90deg, {$this->menu_hover_start}, {$this->menu_hover_end})",
            '--theme-glass-bg' => $this->glass_bg,
            '--theme-glass-border' => $this->glass_border,
        ];
    }

    /**
     * Apply a preset theme
     */
    public function applyPreset($presetKey)
    {
        if (!isset(self::THEME_PRESETS[$presetKey])) {
            return false;
        }

        $preset = self::THEME_PRESETS[$presetKey];
        $this->theme_preset = $presetKey;

        foreach ($preset['colors'] as $field => $value) {
            $this->$field = $value;
        }

        return $this->save();
    }

    /**
     * Get all available presets
     */
    public static function getPresets()
    {
        return self::THEME_PRESETS;
    }

    /**
     * Get preset by key
     */
    public static function getPreset($key)
    {
        return self::THEME_PRESETS[$key] ?? null;
    }
}
