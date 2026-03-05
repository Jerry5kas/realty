<?php

namespace App\Helpers;

use App\Models\ThemeSetting;

class ThemeHelper
{
    public static function primaryColor()
    {
        return ThemeSetting::get('primary_color', '#19376D');
    }

    public static function secondaryColor()
    {
        return ThemeSetting::get('secondary_color', '#D4AF37');
    }

    public static function accentColor()
    {
        return ThemeSetting::get('accent_color', '#0D1B36');
    }

    public static function accent2Color()
    {
        return ThemeSetting::get('accent2_color', '#FFFFFF');
    }

    public static function logoDark()
    {
        return ThemeSetting::get('logo_dark', 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568');
    }

    public static function logoLight()
    {
        return ThemeSetting::get('logo_light', 'https://ik.imagekit.io/area24onestorage/Area24%20one%20logos/area%2024%20realty.png?updatedAt=1770815540228');
    }

    public static function favicon32()
    {
        return ThemeSetting::get('favicon_32', 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-32,h-32');
    }

    public static function favicon180()
    {
        return ThemeSetting::get('favicon_180', 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-180,h-180');
    }

    public static function favicon512()
    {
        return ThemeSetting::get('favicon_512', 'https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568');
    }

    public static function fontFamily()
    {
        return ThemeSetting::get('font_family', 'Inter');
    }

    public static function all()
    {
        return [
            'primary_color' => self::primaryColor(),
            'secondary_color' => self::secondaryColor(),
            'accent_color' => self::accentColor(),
            'accent2_color' => self::accent2Color(),
            'logo_dark' => self::logoDark(),
            'logo_light' => self::logoLight(),
            'favicon_32' => self::favicon32(),
            'favicon_180' => self::favicon180(),
            'favicon_512' => self::favicon512(),
            'font_family' => self::fontFamily(),
        ];
    }
}
