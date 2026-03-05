<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * ThemeSetting Model
 * 
 * Manages global theme settings for the application.
 * All theme values are cached and shared globally via ThemeServiceProvider.
 * 
 * Usage in views: {{ $theme['primary_color'] }}
 * Usage in controllers: ThemeSetting::get('primary_color')
 * Get all settings: ThemeSetting::getAll()
 */
class ThemeSetting extends Model
{
    protected $fillable = ['key', 'value'];

    // Default theme values
    private static $defaults = [
        'primary_color' => '#19376D',
        'secondary_color' => '#D4AF37',
        'accent_color' => '#0D1B36',
        'accent2_color' => '#FFFFFF',
        'logo_dark' => 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568',
        'logo_light' => 'https://ik.imagekit.io/area24onestorage/Area24%20one%20logos/area%2024%20realty.png?updatedAt=1770815540228',
        'favicon_32' => 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-32,h-32',
        'favicon_180' => 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-180,h-180',
        'favicon_512' => 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568',
        'font_family' => 'Inter',
    ];

    public static function get($key, $default = null)
    {
        // Use provided default or fall back to system defaults
        $defaultValue = $default ?? (self::$defaults[$key] ?? null);
        
        return Cache::remember("theme_setting_{$key}", 3600, function () use ($key, $defaultValue) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $defaultValue;
        });
    }

    public static function set($key, $value)
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        
        Cache::forget("theme_setting_{$key}");
        Cache::forget('theme_all_settings');
    }

    public static function getAll()
    {
        return Cache::remember('theme_all_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();
            
            // Merge with defaults for any missing keys
            return array_merge(self::$defaults, $settings);
        });
    }

    public static function clearCache()
    {
        $keys = array_keys(self::$defaults);
        foreach ($keys as $key) {
            Cache::forget("theme_setting_{$key}");
        }
        Cache::forget('theme_all_settings');
    }
}
