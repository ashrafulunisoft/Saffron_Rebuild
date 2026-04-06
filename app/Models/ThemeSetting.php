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
            'name' => 'Emerald Green',
            'description' => 'Fresh nature-inspired greens',
            'preview' => 'linear-gradient(135deg, #10b981, #14b8a6)',
            'colors' => [
                'primary_color' => '#10b981',
                'primary_color_light' => '#34d399',
                'primary_color_dark' => '#059669',
                'secondary_color' => '#14b8a6',
                'secondary_color_dark' => '#0d9488',
                'accent_color' => '#22c55e',
                'bg_gradient_1' => '#052e16',
                'bg_gradient_2' => '#0a3d22',
                'bg_gradient_3' => '#06331a',
                'bg_gradient_4' => '#083920',
                'bg_gradient_5' => '#042a14',
                'btn_gradient_start' => '#10b981',
                'btn_gradient_end' => '#14b8a6',
                'menu_hover_start' => '#10b981',
                'menu_hover_end' => '#14b8a6',
                'text_primary' => '#d1fae5',
                'text_secondary' => '#34d399',
                'glass_bg' => 'rgba(16,185,129,0.08)',
                'glass_border' => 'rgba(16,185,129,0.2)',
            ],
        ],
        'royal_blue' => [
            'name' => 'Sapphire Blue',
            'description' => 'Classic elegant blue tones',
            'preview' => 'linear-gradient(135deg, #3b82f6, #8b5cf6)',
            'colors' => [
                'primary_color' => '#3b82f6',
                'primary_color_light' => '#60a5fa',
                'primary_color_dark' => '#2563eb',
                'secondary_color' => '#8b5cf6',
                'secondary_color_dark' => '#7c3aed',
                'accent_color' => '#06b6d4',
                'bg_gradient_1' => '#0c1929',
                'bg_gradient_2' => '#0f1f3a',
                'bg_gradient_3' => '#0a1630',
                'bg_gradient_4' => '#0e1a35',
                'bg_gradient_5' => '#0b1525',
                'btn_gradient_start' => '#3b82f6',
                'btn_gradient_end' => '#8b5cf6',
                'menu_hover_start' => '#3b82f6',
                'menu_hover_end' => '#8b5cf6',
                'text_primary' => '#dbeafe',
                'text_secondary' => '#60a5fa',
                'glass_bg' => 'rgba(59,130,246,0.08)',
                'glass_border' => 'rgba(59,130,246,0.2)',
            ],
        ],
        'royal_gold' => [
            'name' => 'Champagne Gold',
            'description' => 'Elegant luxury gold theme',
            'preview' => 'linear-gradient(135deg, #eab308, #ca8a04)',
            'colors' => [
                'primary_color' => '#eab308',
                'primary_color_light' => '#facc15',
                'primary_color_dark' => '#a16207',
                'secondary_color' => '#ca8a04',
                'secondary_color_dark' => '#a16207',
                'accent_color' => '#f59e0b',
                'bg_gradient_1' => '#1c1917',
                'bg_gradient_2' => '#292524',
                'bg_gradient_3' => '#1f1a15',
                'bg_gradient_4' => '#252015',
                'bg_gradient_5' => '#1a1510',
                'btn_gradient_start' => '#eab308',
                'btn_gradient_end' => '#ca8a04',
                'menu_hover_start' => '#eab308',
                'menu_hover_end' => '#ca8a04',
                'text_primary' => '#fef9c3',
                'text_secondary' => '#facc15',
                'glass_bg' => 'rgba(234,179,8,0.08)',
                'glass_border' => 'rgba(234,179,8,0.2)',
            ],
        ],
        'purple_haze' => [
            'name' => 'Lavender Dream',
            'description' => 'Soft purple and violet tones',
            'preview' => 'linear-gradient(135deg, #a855f7, #ec4899)',
            'colors' => [
                'primary_color' => '#a855f7',
                'primary_color_light' => '#c084fc',
                'primary_color_dark' => '#9333ea',
                'secondary_color' => '#ec4899',
                'secondary_color_dark' => '#db2777',
                'accent_color' => '#f472b6',
                'bg_gradient_1' => '#1e1028',
                'bg_gradient_2' => '#2a1635',
                'bg_gradient_3' => '#1f1225',
                'bg_gradient_4' => '#251432',
                'bg_gradient_5' => '#1a0e22',
                'btn_gradient_start' => '#a855f7',
                'btn_gradient_end' => '#ec4899',
                'menu_hover_start' => '#a855f7',
                'menu_hover_end' => '#ec4899',
                'text_primary' => '#f3e8ff',
                'text_secondary' => '#c084fc',
                'glass_bg' => 'rgba(168,85,247,0.08)',
                'glass_border' => 'rgba(168,85,247,0.2)',
            ],
        ],
        'sunset_orange' => [
            'name' => 'Coral Sunset',
            'description' => 'Warm coral and peach tones',
            'preview' => 'linear-gradient(135deg, #f97316, #fb7185)',
            'colors' => [
                'primary_color' => '#f97316',
                'primary_color_light' => '#fb923c',
                'primary_color_dark' => '#ea580c',
                'secondary_color' => '#fb7185',
                'secondary_color_dark' => '#f43f5e',
                'accent_color' => '#fbbf24',
                'bg_gradient_1' => '#271a12',
                'bg_gradient_2' => '#2f1f15',
                'bg_gradient_3' => '#251710',
                'bg_gradient_4' => '#2a1a10',
                'bg_gradient_5' => '#22150e',
                'btn_gradient_start' => '#f97316',
                'btn_gradient_end' => '#fb7185',
                'menu_hover_start' => '#f97316',
                'menu_hover_end' => '#fb7185',
                'text_primary' => '#ffedd5',
                'text_secondary' => '#fdba74',
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
