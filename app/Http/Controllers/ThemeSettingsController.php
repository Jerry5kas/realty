<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;

class ThemeSettingsController extends Controller
{
    public function index()
    {
        $settings = ThemeSetting::getAll();
        return view('theme-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'accent_color' => 'required|string',
            'accent2_color' => 'required|string',
            'logo_dark' => 'nullable|string',
            'logo_light' => 'nullable|string',
            'favicon_32' => 'nullable|string',
            'favicon_180' => 'nullable|string',
            'favicon_512' => 'nullable|string',
            'font_family' => 'nullable|string',
        ]);

        ThemeSetting::set('primary_color', $request->primary_color);
        ThemeSetting::set('secondary_color', $request->secondary_color);
        ThemeSetting::set('accent_color', $request->accent_color);
        ThemeSetting::set('accent2_color', $request->accent2_color);
        
        if ($request->logo_dark) {
            ThemeSetting::set('logo_dark', $request->logo_dark);
        }
        
        if ($request->logo_light) {
            ThemeSetting::set('logo_light', $request->logo_light);
        }

        if ($request->favicon_32) {
            ThemeSetting::set('favicon_32', $request->favicon_32);
        }

        if ($request->favicon_180) {
            ThemeSetting::set('favicon_180', $request->favicon_180);
        }

        if ($request->favicon_512) {
            ThemeSetting::set('favicon_512', $request->favicon_512);
        }

        if ($request->font_family) {
            ThemeSetting::set('font_family', $request->font_family);
        }

        ThemeSetting::clearCache();

        return redirect()->route('theme.settings')->with('success', 'Theme settings updated successfully!');
    }
}
