<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\City;
use App\Models\Builder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'New Arrival Projects',
                'slug' => 'new-arrival-projects',
                'description' => 'Discover the latest and newest projects in Bangalore. Fresh launches with modern amenities and prime locations.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%201.png',
                'type' => 'project',
                'status' => 'active',
                'is_featured' => true,
                'display_order' => 1,
                'filters' => [
                    'project_status' => 'upcoming',
                    'created_after' => now()->subDays(90)->format('Y-m-d'),
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
            ],
            [
                'name' => 'Luxury Properties',
                'slug' => 'luxury-properties',
                'description' => 'Explore premium luxury properties with world-class amenities. High-end residences for discerning buyers.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%202.png',
                'type' => 'property',
                'status' => 'active',
                'is_featured' => true,
                'display_order' => 2,
                'filters' => [
                    'min_price' => 10000000, // 1 Crore+
                    'is_featured' => true,
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'price',
                'sort_order' => 'desc',
            ],
            [
                'name' => 'Properties by Popular Builders',
                'slug' => 'popular-builders',
                'description' => 'Explore properties from Bangalore\'s most trusted and popular builders. Quality construction and timely delivery guaranteed.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%203.png',
                'type' => 'mixed',
                'status' => 'active',
                'is_featured' => true,
                'display_order' => 3,
                'filters' => [
                    'builder_id' => $this->getPopularBuilderId(),
                ],
                'manual_items' => null,
                'items_limit' => 16,
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
            ],
            [
                'name' => 'Popular Locations',
                'slug' => 'popular-locations',
                'description' => 'Properties in Bangalore\'s most sought-after locations. Prime areas with excellent connectivity and infrastructure.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%204.png',
                'type' => 'property',
                'status' => 'active',
                'is_featured' => true,
                'display_order' => 4,
                'filters' => [
                    'city_id' => $this->getBangaloreCityId(),
                    'is_featured' => true,
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
            ],
            [
                'name' => 'Ready to Move Properties',
                'slug' => 'ready-to-move',
                'description' => 'Move in immediately! Properties that are ready for possession. No waiting, start living today.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%205.png',
                'type' => 'property',
                'status' => 'active',
                'is_featured' => false,
                'display_order' => 5,
                'filters' => [
                    'possession_status' => 'ready-to-move',
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
            ],
            [
                'name' => 'Affordable Homes',
                'slug' => 'affordable-homes',
                'description' => 'Budget-friendly properties perfect for first-time home buyers. Quality homes at affordable prices.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%206.png',
                'type' => 'property',
                'status' => 'active',
                'is_featured' => false,
                'display_order' => 6,
                'filters' => [
                    'max_price' => 5000000, // Under 50 Lakhs
                    'type' => 'sale',
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'price',
                'sort_order' => 'asc',
            ],
            [
                'name' => '3 BHK Apartments',
                'slug' => '3-bhk-apartments',
                'description' => 'Spacious 3 BHK apartments perfect for families. Comfortable living spaces with modern amenities.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%207.png',
                'type' => 'property',
                'status' => 'active',
                'is_featured' => false,
                'display_order' => 7,
                'filters' => [
                    'bedrooms' => '3',
                    'property_type' => 'apartment',
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'price',
                'sort_order' => 'asc',
            ],
            [
                'name' => 'Ongoing Projects',
                'slug' => 'ongoing-projects',
                'description' => 'Projects currently under construction. Book now and get the best prices and payment plans.',
                'image' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%208.png',
                'type' => 'project',
                'status' => 'active',
                'is_featured' => false,
                'display_order' => 8,
                'filters' => [
                    'project_status' => 'ongoing',
                ],
                'manual_items' => null,
                'items_limit' => 12,
                'sort_by' => 'created_at',
                'sort_order' => 'desc',
            ],
        ];

        foreach ($collections as $collectionData) {
            Collection::create($collectionData);
        }

        $this->command->info('Collections seeded successfully!');
    }

    /**
     * Get Bangalore city ID
     */
    private function getBangaloreCityId()
    {
        $city = City::where('name', 'Bangalore')->orWhere('name', 'Bengaluru')->first();
        return $city ? $city->id : null;
    }

    /**
     * Get a popular builder ID (first builder as example)
     */
    private function getPopularBuilderId()
    {
        $builder = Builder::where('status', 'active')->first();
        return $builder ? $builder->id : null;
    }
}
