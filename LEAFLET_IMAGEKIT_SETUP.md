# Leaflet & ImageKit Configuration

## Overview
This document describes the setup and usage of Leaflet (maps) and ImageKit (image CDN) in the Realty CRM application.

## Leaflet (Maps API)

### Installation
Leaflet has been installed via npm:
```bash
npm install leaflet
```

### Configuration
Leaflet CSS and JS are automatically imported in:
- `resources/css/app.css` - Leaflet CSS
- `resources/js/app.js` - Leaflet JS (available globally as `window.L`)

### Basic Usage

#### HTML Structure
```html
<div id="map" style="height: 400px; width: 100%;"></div>
```

#### JavaScript Implementation
```javascript
// Initialize map
const map = L.map('map').setView([51.505, -0.09], 13);

// Add tile layer (OpenStreetMap - Free)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 19
}).addTo(map);

// Add marker
L.marker([51.5, -0.09]).addTo(map)
    .bindPopup('Property Location')
    .openPopup();
```

### Example: Property Location Map
```blade
<div class="bg-white rounded-xl shadow-lg p-6">
    <h3 class="text-lg font-semibold text-[#19376D] mb-4">Property Location</h3>
    <div id="property-map" class="h-96 rounded-lg overflow-hidden"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map
    const map = L.map('property-map').setView([40.7128, -74.0060], 13);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Add property marker
    L.marker([40.7128, -74.0060]).addTo(map)
        .bindPopup('<b>Property Name</b><br>123 Main St, New York')
        .openPopup();
});
</script>
```

### Free Map Tile Providers
1. **OpenStreetMap** (Default)
   - URL: `https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png`
   - Free, no API key required

2. **CartoDB Positron** (Light theme)
   - URL: `https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png`

3. **CartoDB Dark Matter** (Dark theme)
   - URL: `https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png`

## ImageKit (Image CDN)

### Installation
ImageKit PHP SDK has been installed via Composer:
```bash
composer require imagekit/imagekit
```

### Configuration

#### Environment Variables (.env)
```env
IMAGEKIT_PUBLIC_KEY=public_SNDJOLT+ZF4vOpUoNbqQ/N4S6cM=
IMAGEKIT_PRIVATE_KEY=private_W3O2iRaYTE/YxGJSrw30eEfS+l0=
IMAGEKIT_URL_ENDPOINT=https://ik.imagekit.io/area24onestorage/
```

#### Config File (config/imagekit.php)
Configuration is centralized in `config/imagekit.php`

### Service Class
A service class has been created at `app/Services/ImageKitService.php`

### Usage Examples

#### 1. Generate Image URL with Transformations
```php
use App\Services\ImageKitService;

$imageKit = new ImageKitService();

// Basic URL
$url = $imageKit->url('/path/to/image.jpg');

// With transformations
$url = $imageKit->url('/path/to/image.jpg', [
    ['width' => 400, 'height' => 300],
    ['quality' => 80],
    ['format' => 'webp']
]);
```

#### 2. Upload Image
```php
$imageKit = new ImageKitService();

$result = $imageKit->upload(
    $request->file('image')->path(),
    'property-image-' . time() . '.jpg',
    '/properties'
);

// Result contains: fileId, url, name, etc.
```

#### 3. Delete Image
```php
$imageKit = new ImageKitService();
$imageKit->delete($fileId);
```

#### 4. List Files
```php
$imageKit = new ImageKitService();
$files = $imageKit->listFiles([
    'path' => '/properties',
    'limit' => 10
]);
```

### Blade Helper Example
```blade
@php
    $imageKit = new \App\Services\ImageKitService();
    $imageUrl = $imageKit->url('/properties/house.jpg', [
        ['width' => 800, 'height' => 600],
        ['quality' => 90]
    ]);
@endphp

<img src="{{ $imageUrl }}" alt="Property Image" class="w-full h-auto rounded-lg">
```

### Common Transformations

#### Resize
```php
['width' => 400, 'height' => 300]
```

#### Quality
```php
['quality' => 80] // 1-100
```

#### Format
```php
['format' => 'webp'] // webp, jpg, png
```

#### Crop
```php
['crop' => 'at_max'] // at_max, force, maintain_ratio
```

#### Blur
```php
['blur' => 10] // 1-100
```

## Integration Examples

### Property Listing with Map and Images
```blade
<div class="grid md:grid-cols-2 gap-6">
    <!-- Property Image -->
    <div>
        @php
            $imageKit = new \App\Services\ImageKitService();
            $imageUrl = $imageKit->url('/properties/house.jpg', [
                ['width' => 600, 'height' => 400],
                ['quality' => 90]
            ]);
        @endphp
        <img src="{{ $imageUrl }}" alt="Property" class="w-full rounded-xl">
    </div>
    
    <!-- Property Map -->
    <div>
        <div id="property-map" class="h-96 rounded-xl"></div>
    </div>
</div>

<script>
const map = L.map('property-map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.marker([{{ $property->latitude }}, {{ $property->longitude }}]).addTo(map);
</script>
```

## Best Practices

### Leaflet
1. Always set a height on the map container
2. Use appropriate zoom levels (13-15 for city view)
3. Add attribution for tile providers
4. Consider mobile responsiveness

### ImageKit
1. Always use transformations to optimize images
2. Use WebP format for better compression
3. Set appropriate quality (80-90 for photos)
4. Use lazy loading for better performance
5. Store fileId when uploading for future deletion

## Resources

### Leaflet
- Documentation: https://leafletjs.com/
- Examples: https://leafletjs.com/examples.html
- Plugins: https://leafletjs.com/plugins.html

### ImageKit
- Documentation: https://docs.imagekit.io/
- PHP SDK: https://github.com/imagekit-developer/imagekit-php
- Transformations: https://docs.imagekit.io/features/image-transformations
