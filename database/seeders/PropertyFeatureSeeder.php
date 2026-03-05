<?php

namespace Database\Seeders;

use App\Models\PropertyFeature;
use Illuminate\Database\Seeder;

class PropertyFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            ['name' => 'Modular Kitchen', 'icon' => 'home', 'order' => 1],
            ['name' => 'Air Conditioning', 'icon' => 'wind', 'order' => 2],
            ['name' => 'Wardrobe', 'icon' => 'archive-box', 'order' => 3],
            ['name' => 'False Ceiling', 'icon' => 'squares-2x2', 'order' => 4],
            ['name' => 'Wooden Flooring', 'icon' => 'square-3-stack-3d', 'order' => 5],
            ['name' => 'Vitrified Tiles', 'icon' => 'square-3-stack-3d', 'order' => 6],
            ['name' => 'Marble Flooring', 'icon' => 'square-3-stack-3d', 'order' => 7],
            ['name' => 'Balcony', 'icon' => 'building-office', 'order' => 8],
            ['name' => 'Terrace', 'icon' => 'building', 'order' => 9],
            ['name' => 'Private Garden', 'icon' => 'tree', 'order' => 10],
            ['name' => 'Servant Room', 'icon' => 'user', 'order' => 11],
            ['name' => 'Study Room', 'icon' => 'book-open', 'order' => 12],
            ['name' => 'Pooja Room', 'icon' => 'sparkles', 'order' => 13],
            ['name' => 'Store Room', 'icon' => 'archive-box', 'order' => 14],
            ['name' => 'Vastu Compliant', 'icon' => 'check-circle', 'order' => 15],
            ['name' => 'Pet Friendly', 'icon' => 'heart', 'order' => 16],
            ['name' => 'Piped Gas', 'icon' => 'fire', 'order' => 17],
            ['name' => 'Internet/Wi-Fi', 'icon' => 'wifi', 'order' => 18],
            ['name' => 'Intercom Facility', 'icon' => 'phone', 'order' => 19],
            ['name' => 'Maintenance Staff', 'icon' => 'wrench-screwdriver', 'order' => 20],
        ];

        foreach ($features as $feature) {
            PropertyFeature::create($feature);
        }
    }
}
