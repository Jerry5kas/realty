<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            // Residential
            ['name' => 'Apartment', 'slug' => 'apartment', 'category' => 'residential', 'icon' => 'building', 'order' => 1],
            ['name' => 'Villa', 'slug' => 'villa', 'category' => 'residential', 'icon' => 'home', 'order' => 2],
            ['name' => 'Independent House', 'slug' => 'independent-house', 'category' => 'residential', 'icon' => 'home-modern', 'order' => 3],
            ['name' => 'Builder Floor', 'slug' => 'builder-floor', 'category' => 'residential', 'icon' => 'building-office', 'order' => 4],
            ['name' => 'Penthouse', 'slug' => 'penthouse', 'category' => 'residential', 'icon' => 'building-office-2', 'order' => 5],
            ['name' => 'Studio Apartment', 'slug' => 'studio-apartment', 'category' => 'residential', 'icon' => 'home-modern', 'order' => 6],
            ['name' => 'PG/Hostel', 'slug' => 'pg-hostel', 'category' => 'residential', 'icon' => 'users', 'order' => 7],
            ['name' => 'Farmhouse', 'slug' => 'farmhouse', 'category' => 'residential', 'icon' => 'home', 'order' => 8],
            
            // Commercial
            ['name' => 'Office Space', 'slug' => 'office-space', 'category' => 'commercial', 'icon' => 'building-office', 'order' => 9],
            ['name' => 'Shop', 'slug' => 'shop', 'category' => 'commercial', 'icon' => 'shopping-bag', 'order' => 10],
            ['name' => 'Showroom', 'slug' => 'showroom', 'category' => 'commercial', 'icon' => 'building-storefront', 'order' => 11],
            ['name' => 'Warehouse', 'slug' => 'warehouse', 'category' => 'commercial', 'icon' => 'cube', 'order' => 12],
            ['name' => 'Industrial Building', 'slug' => 'industrial-building', 'category' => 'commercial', 'icon' => 'building', 'order' => 13],
            ['name' => 'Co-working Space', 'slug' => 'co-working-space', 'category' => 'commercial', 'icon' => 'users', 'order' => 14],
            ['name' => 'Restaurant/Cafe', 'slug' => 'restaurant-cafe', 'category' => 'commercial', 'icon' => 'building-storefront', 'order' => 15],
            
            // Land
            ['name' => 'Residential Plot', 'slug' => 'residential-plot', 'category' => 'land', 'icon' => 'map', 'order' => 16],
            ['name' => 'Commercial Plot', 'slug' => 'commercial-plot', 'category' => 'land', 'icon' => 'map', 'order' => 17],
            ['name' => 'Agricultural Land', 'slug' => 'agricultural-land', 'category' => 'land', 'icon' => 'map', 'order' => 18],
            ['name' => 'Industrial Plot', 'slug' => 'industrial-plot', 'category' => 'land', 'icon' => 'map', 'order' => 19],
        ];

        foreach ($types as $type) {
            PropertyType::create($type);
        }
    }
}
