<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Get a setting value by key with caching
     */
    public static function get(string $key, $default = null)
    {
        return Cache::remember("settings.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value): void
    {
        $setting = static::where('key', $key)->firstOrFail();
        $setting->update(['value' => $value]);
        Cache::forget("settings.{$key}");
    }

    /**
     * Get shipping charge inside Dhaka
     */
    public static function getShippingInsideDhaka(): float
    {
        return (float) self::get('shipping_inside_dhaka', 60);
    }

    /**
     * Get shipping charge outside Dhaka
     */
    public static function getShippingOutsideDhaka(): float
    {
        return (float) self::get('shipping_outside_dhaka', 120);
    }

    /**
     * Get free shipping threshold
     */
    public static function getFreeShippingThreshold(): float
    {
        return (float) self::get('free_shipping_threshold', 1000);
    }

    /**
     * Clear settings cache
     */
    public static function clearCache(): void
    {
        $settings = static::all();
        foreach ($settings as $setting) {
            Cache::forget("settings.{$setting->key}");
        }
    }
}
