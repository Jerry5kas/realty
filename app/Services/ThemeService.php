<?php

namespace App\Services;

class ThemeService
{
    /**
     * Calculate luminance of a color to determine if it's light or dark
     * 
     * @param string $hexColor Color in hex format (#RRGGBB)
     * @return float Luminance value between 0 (dark) and 1 (light)
     */
    public static function getLuminance($hexColor)
    {
        // Remove # if present
        $hexColor = ltrim($hexColor, '#');
        
        // Convert hex to RGB
        $r = hexdec(substr($hexColor, 0, 2)) / 255;
        $g = hexdec(substr($hexColor, 2, 2)) / 255;
        $b = hexdec(substr($hexColor, 4, 2)) / 255;
        
        // Apply gamma correction
        $r = ($r <= 0.03928) ? $r / 12.92 : pow(($r + 0.055) / 1.055, 2.4);
        $g = ($g <= 0.03928) ? $g / 12.92 : pow(($g + 0.055) / 1.055, 2.4);
        $b = ($b <= 0.03928) ? $b / 12.92 : pow(($b + 0.055) / 1.055, 2.4);
        
        // Calculate relative luminance
        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }
    
    /**
     * Determine if a background color is light or dark
     * 
     * @param string $hexColor Background color in hex format
     * @return bool True if light, false if dark
     */
    public static function isLightColor($hexColor)
    {
        return self::getLuminance($hexColor) > 0.5;
    }
    
    /**
     * Get appropriate text color (white or dark) for a given background color
     * 
     * @param string $bgColor Background color in hex format
     * @param string $darkColor Dark text color (default: #0D1B36)
     * @param string $lightColor Light text color (default: #FFFFFF)
     * @return string Appropriate text color
     */
    public static function getContrastTextColor($bgColor, $darkColor = '#0D1B36', $lightColor = '#FFFFFF')
    {
        return self::isLightColor($bgColor) ? $darkColor : $lightColor;
    }
    
    /**
     * Get all theme colors with their appropriate text colors
     * 
     * @param array $theme Theme settings array
     * @return array Theme with text color mappings
     */
    public static function getThemeWithTextColors($theme)
    {
        return [
            'primary_color' => $theme['primary_color'] ?? '#19376D',
            'primary_text' => self::getContrastTextColor($theme['primary_color'] ?? '#19376D'),
            
            'secondary_color' => $theme['secondary_color'] ?? '#D4AF37',
            'secondary_text' => self::getContrastTextColor($theme['secondary_color'] ?? '#D4AF37'),
            
            'accent_color' => $theme['accent_color'] ?? '#0D1B36',
            'accent_text' => self::getContrastTextColor($theme['accent_color'] ?? '#0D1B36'),
            
            'accent2_color' => $theme['accent2_color'] ?? '#FFFFFF',
            'accent2_text' => self::getContrastTextColor($theme['accent2_color'] ?? '#FFFFFF'),
        ];
    }
}
