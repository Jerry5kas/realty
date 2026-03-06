<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            // Basic
            ['name' => 'Power Backup', 'category' => 'basic', 'icon' => 'bolt', 'order' => 1],
            ['name' => 'Lift', 'category' => 'basic', 'icon' => 'arrow-up-circle', 'order' => 2],
            ['name' => 'Water Supply', 'category' => 'basic', 'icon' => 'water', 'order' => 3],
            ['name' => 'Parking', 'category' => 'basic', 'icon' => 'square-parking', 'order' => 4],
            ['name' => 'Visitor Parking', 'category' => 'basic', 'icon' => 'square-parking', 'order' => 5],
            
            // Security
            ['name' => '24x7 Security', 'category' => 'security', 'icon' => 'shield-check', 'order' => 6],
            ['name' => 'CCTV Surveillance', 'category' => 'security', 'icon' => 'video-camera', 'order' => 7],
            ['name' => 'Intercom', 'category' => 'security', 'icon' => 'phone', 'order' => 8],
            ['name' => 'Fire Safety', 'category' => 'security', 'icon' => 'fire', 'order' => 9],
            ['name' => 'Gated Community', 'category' => 'security', 'icon' => 'lock-closed', 'order' => 10],
            
            // Recreational
            ['name' => 'Swimming Pool', 'category' => 'recreational', 'icon' => 'water', 'order' => 11],
            ['name' => 'Gymnasium', 'category' => 'recreational', 'icon' => 'heart', 'order' => 12],
            ['name' => 'Club House', 'category' => 'recreational', 'icon' => 'building', 'order' => 13],
            ['name' => 'Children Play Area', 'category' => 'recreational', 'icon' => 'puzzle-piece', 'order' => 14],
            ['name' => 'Indoor Games', 'category' => 'recreational', 'icon' => 'game-controller', 'order' => 15],
            ['name' => 'Jogging Track', 'category' => 'recreational', 'icon' => 'shoe-sneaker', 'order' => 16],
            ['name' => 'Sports Facility', 'category' => 'recreational', 'icon' => 'trophy', 'order' => 17],
            ['name' => 'Party Hall', 'category' => 'recreational', 'icon' => 'cake', 'order' => 18],
            ['name' => 'Yoga/Meditation Area', 'category' => 'recreational', 'icon' => 'user', 'order' => 19],
            
            // Luxury
            ['name' => 'Landscaped Garden', 'category' => 'luxury', 'icon' => 'tree', 'order' => 20],
            ['name' => 'Spa', 'category' => 'luxury', 'icon' => 'sparkles', 'order' => 21],
            ['name' => 'Sauna', 'category' => 'luxury', 'icon' => 'fire', 'order' => 22],
            ['name' => 'Jacuzzi', 'category' => 'luxury', 'icon' => 'water', 'order' => 23],
            ['name' => 'Home Theater', 'category' => 'luxury', 'icon' => 'film', 'order' => 24],
            ['name' => 'Concierge Service', 'category' => 'luxury', 'icon' => 'user-tie', 'order' => 25],
            ['name' => 'Valet Parking', 'category' => 'luxury', 'icon' => 'car', 'order' => 26],
            
            // Eco-friendly
            ['name' => 'Rainwater Harvesting', 'category' => 'eco-friendly', 'icon' => 'cloud-rain', 'order' => 27],
            ['name' => 'Solar Panels', 'category' => 'eco-friendly', 'icon' => 'sun', 'order' => 28],
            ['name' => 'Waste Management', 'category' => 'eco-friendly', 'icon' => 'trash', 'order' => 29],
            ['name' => 'Sewage Treatment Plant', 'category' => 'eco-friendly', 'icon' => 'beaker', 'order' => 30],
            ['name' => 'EV Charging Station', 'category' => 'eco-friendly', 'icon' => 'bolt', 'order' => 31],
        ];

        foreach ($amenities as $amenity) {
            $amenity['slug'] = Str::slug($amenity['name']);
            Amenity::create($amenity);
        }
    }
}
