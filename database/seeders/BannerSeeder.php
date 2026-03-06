<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Find Your Dream Home',
                'image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/m1.png?updatedAt=1772104772222',
                'mobile_image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%20mobile%20view%20(1).png?updatedAt=1772102189454',
                'page' => 'home',
                'section' => 'hero',
                'link_url' => '/properties',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Luxury Living Spaces',
                'image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/m2.png?updatedAt=1772104790827',
                'mobile_image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%20mobile%20view%206.png',
                'page' => 'home',
                'section' => 'hero',
                'link_url' => '/properties',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Smart Investment Options',
                'image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/m3.png?updatedAt=1772104808067',
                'mobile_image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%20mobile%20view%204.png?updatedAt=1772102189264',
                'page' => 'home',
                'section' => 'hero',
                'link_url' => '/properties',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Your Perfect Property Awaits',
                'image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/m4.png?updatedAt=1772104831761',
                'mobile_image_url' => 'https://ik.imagekit.io/area24onestorage/Realty%20banners/AREA24%20REALTY%20BANNER%20mobile%20view%205.png?updatedAt=1772102189279',
                'page' => 'home',
                'section' => 'hero',
                'link_url' => '/properties',
                'display_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
