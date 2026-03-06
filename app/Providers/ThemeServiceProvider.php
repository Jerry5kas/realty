<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ThemeSetting;
use App\Services\ThemeService;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share theme settings with all views
        View::composer('*', function ($view) {
            $themeSettings = ThemeSetting::getAll();
            $themeColors = ThemeService::getThemeWithTextColors($themeSettings);
            
            // Merge all theme data
            $theme = array_merge($themeSettings, $themeColors);
            
            $view->with('theme', $theme);
        });
    }

    public function register(): void
    {
        //
    }
}
