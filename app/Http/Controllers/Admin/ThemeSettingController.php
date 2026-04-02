<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;

class ThemeSettingController extends Controller
{
    /**
     * Display theme settings page
     */
    public function index()
    {
        $theme = ThemeSetting::getActive();
        return view('admin.theme-settings.index', compact('theme'));
    }

    /**
     * Update theme settings
     */
    public function update(Request $request)
    {
        try {
            $theme = ThemeSetting::getActive();

            // Get all color fields from the request
            $colorFields = [
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
            ];

            // Update each field if present in request
            foreach ($colorFields as $field) {
                if ($request->has($field)) {
                    $theme->$field = $request->input($field);
                }
            }

            $theme->save();

            return redirect()->back()->with('success', 'Theme settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update theme settings: ' . $e->getMessage());
        }
    }

    /**
     * Reset to default theme
     */
    public function reset()
    {
        try {
            $theme = ThemeSetting::getActive();

            // Update with default values
            $theme->update([
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
            ]);

            return redirect()->back()->with('success', 'Theme reset to default settings!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reset theme: ' . $e->getMessage());
        }
    }

    /**
     * Get theme CSS for frontend (API endpoint)
     */
    public function getCss()
    {
        $theme = ThemeSetting::getActive();
        $variables = $theme->toCssVariables();

        $css = ':root {';
        foreach ($variables as $name => $value) {
            $css .= "{$name}: {$value};";
        }
        $css .= '}';

        return response($css)->header('Content-Type', 'text/css');
    }
}
