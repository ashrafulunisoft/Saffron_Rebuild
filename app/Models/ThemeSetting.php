<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
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
}
