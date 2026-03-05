<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ThemeSetting;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share theme settings with all views
        View::composer('*', function ($view) {
            $view->with('theme', ThemeSetting::getAll());
        });
    }

    public function register(): void
    {
        //
    }
}
