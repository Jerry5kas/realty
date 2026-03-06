# Theme System Documentation

## How It Works

### 1. Database Storage
Theme colors are stored in the `theme_settings` table with key-value pairs:
- `primary_color` → #19376D (Deep Blue)
- `secondary_color` → #D4AF37 (Gold)
- `accent_color` → #0D1B36 (Dark Blue)
- `accent2_color` → #FFFFFF (White)

### 2. Theme Service Provider
`App\Providers\ThemeServiceProvider` loads theme settings and makes them available to ALL views via the `$theme` variable.

### 3. Theme Service (NEW!)
`App\Services\ThemeService` provides smart text color detection:
- Calculates color luminance
- Determines if background is light or dark
- Returns appropriate text color (white for dark backgrounds, dark for light backgrounds)

### 4. Available Theme Variables

In any Blade view, you can use:

```php
// Background Colors
{{ $theme['primary_color'] }}      // #19376D
{{ $theme['secondary_color'] }}    // #D4AF37
{{ $theme['accent_color'] }}       // #0D1B36
{{ $theme['accent2_color'] }}      // #FFFFFF

// Smart Text Colors (Auto-calculated)
{{ $theme['primary_text'] }}       // White (because primary is dark)
{{ $theme['secondary_text'] }}     // Dark (because secondary/gold is light)
{{ $theme['accent_text'] }}        // White (because accent is dark)
{{ $theme['accent2_text'] }}       // Dark (because accent2 is white)

// Other Theme Settings
{{ $theme['logo_dark'] }}
{{ $theme['logo_light'] }}
{{ $theme['font_family'] }}
```

## Usage Examples

### Button with Smart Text Color
```html
<button style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
    Search
</button>
```

### Tab with Active State
```css
.tab.active {
    background-color: {{ $theme['secondary_color'] }};
    color: {{ $theme['secondary_text'] }};
}
```

### Dynamic Styling
```html
<div style="background-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_text'] }};">
    This text will always be readable!
</div>
```

## How Smart Detection Works

The `ThemeService::getContrastTextColor()` method:
1. Converts hex color to RGB
2. Applies gamma correction
3. Calculates relative luminance (0-1 scale)
4. If luminance > 0.5 → Light background → Use dark text
5. If luminance ≤ 0.5 → Dark background → Use white text

## Benefits

✅ **Automatic** - No manual color selection needed
✅ **Accessible** - Ensures proper contrast ratios
✅ **Dynamic** - Works with any theme colors from admin
✅ **Consistent** - Same logic across entire application
✅ **Cached** - Theme values are cached for performance

## Updating Theme Colors

Admin can update colors in Theme Settings, and text colors will automatically adjust:
- Light gold button → Gets dark text
- Dark blue button → Gets white text
- Custom colors → Automatically calculated

## No More Manual Overrides!

Before:
```css
.button { color: white !important; } /* Breaks with light backgrounds */
```

After:
```html
<button style="background-color: {{ $theme['secondary_color'] }}; color: {{ $theme['secondary_text'] }};">
    Always readable!
</button>
```
