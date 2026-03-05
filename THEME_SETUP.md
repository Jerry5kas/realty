# Realty CRM - Theme Setup Documentation

## Overview
This document describes the light theme configuration for the Realty CRM application.

## Color Palette

### Primary Color - Deep Blue
- **Hex:** `#19376D`
- **RGB:** `25, 55, 109`
- **Usage:** Headers, sidebar, navigation, and primary UI elements
- **Tailwind Class:** `bg-[#19376D]`, `text-[#19376D]`, `border-[#19376D]`

### Secondary Color - Gold
- **Hex:** `#D4AF37`
- **RGB:** `212, 175, 55`
- **Usage:** Accents, borders, highlights, and call-to-action elements
- **Tailwind Class:** `bg-[#D4AF37]`, `text-[#D4AF37]`, `border-[#D4AF37]`

### Accent Color - Dark Blue
- **Hex:** `#0D1B36`
- **RGB:** `13, 27, 54`
- **Usage:** Text, buttons, and dark UI elements
- **Tailwind Class:** `bg-[#0D1B36]`, `text-[#0D1B36]`, `border-[#0D1B36]`

### Background Color - White
- **Hex:** `#FFFFFF`
- **RGB:** `255, 255, 255`
- **Usage:** Main background color for the application
- **Tailwind Class:** `bg-white`

## Logos

### Dark Logo (For Light Backgrounds)
- **URL:** `https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568`
- **Usage:** Dashboard header, light backgrounds
- **Size:** 512x512px

### White Logo (For Dark Backgrounds)
- **URL:** `https://ik.imagekit.io/area24onestorage/Area24%20one%20logos/area%2024%20realty.png?updatedAt=1770815540228`
- **Usage:** Login page, sidebar, dark backgrounds
- **Size:** Variable (maintains aspect ratio)

## Favicons

### 32x32 (Standard Favicon)
- **URL:** `https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-32,h-32`
- **Usage:** Browser tabs, bookmarks

### 180x180 (Apple Touch Icon)
- **URL:** `https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568&tr=w-180,h-180`
- **Usage:** iOS home screen icons

### 512x512 (High Resolution)
- **URL:** `https://ik.imagekit.io/area24onestorage/assets/512X512__4__QjTPJZdsn.png?updatedAt=1771657289568`
- **Usage:** High-resolution displays, PWA icons

## Layout Structure

### Admin Layout (`resources/views/layouts/admin.blade.php`)
The admin layout provides a responsive structure with:

#### Sidebar
- Fixed on desktop (lg breakpoint and above)
- Slide-out drawer on mobile
- Deep Blue background (`#19376D`)
- White text
- Gold accent borders and hover states
- Logo at the top
- Navigation menu
- User profile section at the bottom

#### Top Navbar
- White background
- Deep Blue text
- Mobile menu toggle button
- Page title
- Notification icon
- Logout button with Dark Blue background

#### Content Area
- Light gray background (`bg-gray-50`)
- Responsive padding
- Scrollable content

### Mobile Responsiveness
- **Mobile (< 1024px):**
  - Sidebar hidden by default
  - Hamburger menu button visible
  - Overlay when sidebar is open
  - Full-width content

- **Desktop (≥ 1024px):**
  - Sidebar always visible
  - No hamburger menu
  - Content area adjusts to sidebar width

## Pages

### Login Page (`resources/views/auth/login.blade.php`)
- White background
- Deep Blue card with Gold borders
- White logo displayed
- White text on dark card
- Gold button with white text
- Responsive design

### Dashboard (`resources/views/dashboard.blade.php`)
- Uses admin layout
- Stats cards with color-coded borders
- Deep Blue header sections
- White content cards

### Theme Settings (`resources/views/theme-settings.blade.php`)
- Displays all logos (dark and white)
- Shows all favicon sizes
- Color palette with hex and RGB values
- Theme preview section
- Usage descriptions for each color

## CSS Configuration (`resources/css/app.css`)

### Custom CSS Variables
```css
--color-primary: 25 55 109;      /* Deep Blue */
--color-secondary: 212 175 55;   /* Gold */
--color-accent: 13 27 54;        /* Dark Blue */
--color-background: 255 255 255; /* White */
```

### Custom Utility Classes
- `.bg-primary` - Deep Blue background
- `.bg-secondary` - Gold background
- `.bg-accent` - Dark Blue background
- `.text-primary` - Deep Blue text
- `.text-secondary` - Gold text
- `.text-accent` - Dark Blue text
- `.border-primary` - Deep Blue border
- `.border-secondary` - Gold border
- `.border-accent` - Dark Blue border

## Routes

### Theme Settings Route
```php
Route::get('/theme-settings', function () {
    return view('theme-settings');
})->middleware('auth')->name('theme.settings');
```

Access the theme settings page at: `/theme-settings`

## Configuration File (`config/theme.php`)

The theme configuration is centralized in `config/theme.php` for easy maintenance and updates. Access theme values in your code:

```php
config('theme.colors.primary.hex')  // Returns '#19376D'
config('theme.logos.dark')          // Returns dark logo URL
config('theme.favicons.32x32')      // Returns 32x32 favicon URL
```

## Best Practices

1. **Consistency:** Always use the defined color palette
2. **Contrast:** Ensure text has sufficient contrast against backgrounds
3. **Accessibility:** Maintain WCAG AA compliance for color contrast
4. **Responsive:** Test all pages on mobile, tablet, and desktop
5. **Performance:** Use optimized images from ImageKit CDN

## Future Enhancements

- Theme switcher (light/dark mode)
- Custom color picker for admin users
- Logo upload functionality
- Theme export/import feature
- Multiple theme presets
