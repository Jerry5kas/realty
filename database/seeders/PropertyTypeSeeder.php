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
            ['name' => 'Apartment', 'category' => 'residential', 'icon' => 'building', 'order' => 1],
            ['name' => 'Villa', 'category' => 'residential', 'icon' => 'home', 'order' => 2],
            ['name' => 'Independent House', 'category' => 'residential', 'icon' => 'home-modern', 'order' => 3],
            ['name' => 'Builder Floor', 'category' => 'residential', 'icon' => 'building-office', 'order' => 4],
            ['name' => 'Penthouse', 'category' => 'residential', 'icon' => 'building-office-2', 'order' => 5],
            ['name' => 'Studio Apartment', 'category' => 'residential', 'icon' => 'home-modern', 'order' => 6],
            ['name' => 'PG/Hostel', 'category' => 'residential', 'icon' => 'users', 'order' => 7],
            ['name' => 'Farmhouse', 'category' => 'residential', 'icon' => 'home', 'order' => 8],
            
            // Commercial
            ['name' => 'Office Space', 'category' => 'commercial', 'icon' => 'building-office', 'order' => 9],
            ['name' => 'Shop', 'category' => 'commercial', 'icon' => 'shopping-bag', 'order' => 10],
            ['name' => 'Showroom', 'category' => 'commercial', 'icon' => 'building-storefront', 'order' => 11],
            ['name' => 'Warehouse', 'category' => 'commercial', 'icon' => 'cube', 'order' => 12],
            ['name' => 'Industrial Building', 'category' => 'commercial', 'icon' => 'building', 'order' => 13],
            ['name' => 'Co-working Space', 'category' => 'commercial', 'icon' => 'users', 'order' => 14],
            ['name' => 'Restaurant/Cafe', 'category' => 'commercial', 'icon' => 'building-storefront', 'order' => 15],
            
            // Land
            ['name' => 'Residential Plot', 'category' => 'land', 'icon' => 'map', 'order' => 16],
            ['name' => 'Commercial Plot', 'category' => 'land', 'icon' => 'map', 'order' => 17],
            ['name' => 'Agricultural Land', 'category' => 'land', 'icon' => 'map', 'order' => 18],
            ['name' => 'Industrial Plot', 'category' => 'land', 'icon' => 'map', 'order' => 19],
        ];

        foreach ($types as $type) {
            PropertyType::create($type);
        }
    }
}
