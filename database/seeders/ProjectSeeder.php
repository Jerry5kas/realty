<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Builder;
use App\Models\City;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Get builders
        $emaar = Builder::where('company_name', 'Emaar Properties')->first();
        $prestige = Builder::where('company_name', 'Prestige Group')->first();
        $brigade = Builder::where('company_name', 'Brigade Group')->first();
        $sobha = Builder::where('company_name', 'Sobha Limited')->first();
        $puravankara = Builder::where('company_name', 'Puravankara Limited')->first();

        // Get cities
        $bangalore = City::where('name', 'Bangalore')->first();
        $mysore = City::where('name', 'Mysore')->first();

        $projects = [
            [
                'name' => 'Greencrest Residency',
                'description' => 'A premium residential project offering luxury apartments with world-class amenities in the heart of Whitefield.',
                'highlights' => 'Swimming Pool, Gym, Clubhouse, Children\'s Play Area, 24/7 Security',
                'builder_id' => $emaar->id,
                'project_type' => 'residential',
                'status' => 'under-construction',
                'launch_date' => now()->subMonths(6),
                'possession_date' => now()->addMonths(18),
                'completion_percentage' => 45,
                'total_units' => 250,
                'available_units' => 120,
                'total_towers' => 3,
                'total_floors' => 15,
                'total_area' => 5.5,
                'min_price' => 8500000,
                'max_price' => 25000000,
                'city_id' => $bangalore->id,
                'locality' => 'Whitefield',
                'address' => 'ITPL Main Road, Whitefield, Bangalore',
                'pincode' => '560066',
                'rera_number' => 'PRM/KA/RERA/1251/446/PR/171120/002345',
                'rera_valid_till' => now()->addYears(3),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2399.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/4400.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/1849.png',
                ],
                'is_featured' => true,
                'is_verified' => true,
                'publish_status' => 'published',
            ],
            [
                'name' => 'Aurea Heights',
                'description' => 'Modern apartments with contemporary design and premium specifications in Koramangala.',
                'highlights' => 'Rooftop Garden, Indoor Games, Yoga Deck, Party Hall, Smart Home Features',
                'builder_id' => $emaar->id,
                'project_type' => 'residential',
                'status' => 'under-construction',
                'launch_date' => now()->subMonths(3),
                'possession_date' => now()->addMonths(24),
                'completion_percentage' => 30,
                'total_units' => 180,
                'available_units' => 95,
                'total_towers' => 2,
                'total_floors' => 20,
                'total_area' => 4.2,
                'min_price' => 15000000,
                'max_price' => 35000000,
                'city_id' => $bangalore->id,
                'locality' => 'Koramangala',
                'address' => '5th Block, Koramangala, Bangalore',
                'pincode' => '560095',
                'rera_number' => 'PRM/KA/RERA/1251/446/PR/180920/003456',
                'rera_valid_till' => now()->addYears(4),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2025.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2799.png',
                ],
                'is_featured' => true,
                'is_verified' => true,
                'publish_status' => 'published',
            ],
            [
                'name' => 'Palmiera Collective',
                'description' => 'Ultra-luxury villa community with private gardens and premium amenities in Mysore.',
                'highlights' => 'Private Pool, Landscaped Gardens, Concierge Service, Golf Course Access',
                'builder_id' => $emaar->id,
                'project_type' => 'residential',
                'status' => 'under-construction',
                'launch_date' => now()->subMonths(12),
                'possession_date' => now()->addMonths(12),
                'completion_percentage' => 65,
                'total_units' => 45,
                'available_units' => 12,
                'total_towers' => 0,
                'total_floors' => 2,
                'total_area' => 15.0,
                'min_price' => 80000000,
                'max_price' => 180000000,
                'city_id' => $mysore->id,
                'locality' => 'Jayalakshmipuram',
                'address' => 'Ring Road, Jayalakshmipuram, Mysore',
                'pincode' => '570012',
                'rera_number' => 'PRM/KA/RERA/1251/446/PR/150819/004567',
                'rera_valid_till' => now()->addYears(2),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/1849.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/4400.png',
                ],
                'is_featured' => true,
                'is_verified' => true,
                'publish_status' => 'published',
            ],
            [
                'name' => 'Prestige Skyline',
                'description' => 'Premium high-rise apartments with panoramic city views and state-of-the-art amenities.',
                'highlights' => 'Sky Lounge, Infinity Pool, Spa, Business Center, Valet Parking',
                'builder_id' => $prestige->id,
                'project_type' => 'residential',
                'status' => 'ready-to-move',
                'launch_date' => now()->subYears(2),
                'possession_date' => now()->subMonths(2),
                'completion_percentage' => 100,
                'total_units' => 320,
                'available_units' => 25,
                'total_towers' => 4,
                'total_floors' => 25,
                'total_area' => 8.5,
                'min_price' => 12000000,
                'max_price' => 45000000,
                'city_id' => $bangalore->id,
                'locality' => 'Indiranagar',
                'address' => '100 Feet Road, Indiranagar, Bangalore',
                'pincode' => '560038',
                'rera_number' => 'PRM/KA/RERA/1251/446/PR/120718/005678',
                'rera_valid_till' => now()->addYear(),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2799.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2399.png',
                ],
                'is_featured' => true,
                'is_verified' => true,
                'publish_status' => 'published',
            ],
            [
                'name' => 'Brigade Meadows',
                'description' => 'Spacious apartments surrounded by lush greenery with excellent connectivity.',
                'highlights' => 'Jogging Track, Tennis Court, Amphitheater, Meditation Center',
                'builder_id' => $brigade->id,
                'project_type' => 'residential',
                'status' => 'under-construction',
                'launch_date' => now()->subMonths(8),
                'possession_date' => now()->addMonths(16),
                'completion_percentage' => 50,
                'total_units' => 280,
                'available_units' => 140,
                'total_towers' => 5,
                'total_floors' => 12,
                'total_area' => 6.8,
                'min_price' => 9500000,
                'max_price' => 28000000,
                'city_id' => $bangalore->id,
                'locality' => 'Sarjapur Road',
                'address' => 'Sarjapur Main Road, Bangalore',
                'pincode' => '560103',
                'rera_number' => 'PRM/KA/RERA/1251/446/PR/200620/006789',
                'rera_valid_till' => now()->addYears(3),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2025.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/1849.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/4400.png',
                ],
                'is_featured' => true,
                'is_verified' => true,
                'publish_status' => 'published',
            ],
        ];

        foreach ($projects as $project) {
            $project['slug'] = Str::slug($project['name']);
            Project::create($project);
        }
    }
}
