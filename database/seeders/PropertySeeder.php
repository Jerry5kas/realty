<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\City;
use App\Models\User;
use App\Models\Builder;
use App\Models\Project;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        
        // Get Karnataka cities
        $bangalore = City::where('name', 'Bangalore')->first();
        $mysore = City::where('name', 'Mysore')->first();
        $ballari = City::where('name', 'Ballari')->first();

        // Get builders
        $emaar = Builder::where('company_name', 'Emaar Properties')->first();
        $prestige = Builder::where('company_name', 'Prestige Group')->first();
        $brigade = Builder::where('company_name', 'Brigade Group')->first();
        $sobha = Builder::where('company_name', 'Sobha Limited')->first();

        // Get projects
        $greencrest = Project::where('name', 'Greencrest Residency')->first();
        $aurea = Project::where('name', 'Aurea Heights')->first();
        $palmiera = Project::where('name', 'Palmiera Collective')->first();
        $skyline = Project::where('name', 'Prestige Skyline')->first();
        $meadows = Project::where('name', 'Brigade Meadows')->first();

        $properties = [
            [
                'title' => 'Greencrest 1BHK Apartment',
                'description' => 'Luxury 1BHK apartment in Greencrest Residency with modern amenities and stunning views.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'apartment',
                'price' => 15848880,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'carpet_area' => 650,
                'area_unit' => 'sqft',
                'city_id' => $bangalore->id,
                'locality' => 'Whitefield',
                'address' => 'Greencrest Residency, Whitefield, Bangalore',
                'furnishing_status' => 'semi-furnished',
                'possession_status' => 'under-construction',
                'possession_date' => now()->addMonths(18),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2399.png'
                ],
                'builder_id' => $emaar->id,
                'project_id' => $greencrest->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Aurea 3BHK Premium',
                'description' => 'Premium 3BHK apartment in Aurea Heights with world-class facilities and payment plans.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'apartment',
                'price' => 23100000,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'carpet_area' => 1450,
                'area_unit' => 'sqft',
                'city_id' => $bangalore->id,
                'locality' => 'Koramangala',
                'address' => 'Aurea Heights, Koramangala, Bangalore',
                'furnishing_status' => 'unfurnished',
                'possession_status' => 'under-construction',
                'possession_date' => now()->addMonths(24),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/4400.png'
                ],
                'builder_id' => $emaar->id,
                'project_id' => $aurea->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Palmiera Luxury Villa',
                'description' => 'Ultra-luxury 4BHK villa in Palmiera Collective with private amenities.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'villa',
                'price' => 136000000,
                'bedrooms' => 4,
                'bathrooms' => 5,
                'carpet_area' => 3500,
                'area_unit' => 'sqft',
                'city_id' => $mysore->id,
                'locality' => 'Jayalakshmipuram',
                'address' => 'Palmiera Collective, Jayalakshmipuram, Mysore',
                'furnishing_status' => 'furnished',
                'possession_status' => 'under-construction',
                'possession_date' => now()->addMonths(12),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/1849.png'
                ],
                'builder_id' => $emaar->id,
                'project_id' => $palmiera->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Skyline Residency 2BHK',
                'description' => 'Modern 2BHK apartment in Prestige Skyline with panoramic city views.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'apartment',
                'price' => 8500000,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'carpet_area' => 1100,
                'area_unit' => 'sqft',
                'city_id' => $bangalore->id,
                'locality' => 'Indiranagar',
                'address' => 'Prestige Skyline, Indiranagar, Bangalore',
                'furnishing_status' => 'semi-furnished',
                'possession_status' => 'ready-to-move',
                'available_from' => now(),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2025.png'
                ],
                'builder_id' => $prestige->id,
                'project_id' => $skyline->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Ocean View Apartments',
                'description' => 'Luxury apartments with stunning views and resort-style living.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'apartment',
                'price' => 12750000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'carpet_area' => 1350,
                'area_unit' => 'sqft',
                'city_id' => $bangalore->id,
                'locality' => 'Hebbal',
                'address' => 'Hebbal, Bangalore',
                'furnishing_status' => 'furnished',
                'possession_status' => 'ready-to-move',
                'available_from' => now()->addMonth(),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2799.png'
                ],
                'builder_id' => $sobha->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Heritage Villas',
                'description' => 'Spacious independent villas with traditional architecture and modern comforts.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'villa',
                'price' => 18900000,
                'bedrooms' => 4,
                'bathrooms' => 4,
                'carpet_area' => 2800,
                'area_unit' => 'sqft',
                'city_id' => $mysore->id,
                'locality' => 'Vijayanagar',
                'address' => 'Vijayanagar, Mysore',
                'furnishing_status' => 'semi-furnished',
                'possession_status' => 'ready-to-move',
                'available_from' => now()->addMonths(2),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2399.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/4400.png'
                ],
                'builder_id' => $sobha->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Tech Park Towers',
                'description' => 'Premium office spaces near major IT parks with state-of-the-art infrastructure.',
                'type' => 'rent',
                'category' => 'commercial',
                'property_type' => 'office',
                'price' => 150000,
                'carpet_area' => 2500,
                'area_unit' => 'sqft',
                'city_id' => $ballari->id,
                'locality' => 'City Center',
                'address' => 'City Center, Ballari',
                'furnishing_status' => 'furnished',
                'possession_status' => 'ready-to-move',
                'available_from' => now(),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/1849.png'
                ],
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
            [
                'title' => 'Brigade Meadows 3BHK',
                'description' => 'Eco-friendly 3BHK apartment in Brigade Meadows with sustainable living features.',
                'type' => 'sale',
                'category' => 'residential',
                'property_type' => 'apartment',
                'price' => 9850000,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'carpet_area' => 1650,
                'area_unit' => 'sqft',
                'city_id' => $bangalore->id,
                'locality' => 'Sarjapur Road',
                'address' => 'Brigade Meadows, Sarjapur Road, Bangalore',
                'furnishing_status' => 'unfurnished',
                'possession_status' => 'under-construction',
                'possession_date' => now()->addMonths(16),
                'images' => [
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2025.png',
                    'https://ik.imagekit.io/area24onestorage/Realty%20banners/2799.png'
                ],
                'builder_id' => $brigade->id,
                'project_id' => $meadows->id,
                'user_id' => $admin->id,
                'status' => 'published',
                'is_featured' => true,
                'is_verified' => true,
            ],
        ];

        foreach ($properties as $property) {
            $property['slug'] = Str::slug($property['title']);
            Property::create($property);
        }
    }
}
