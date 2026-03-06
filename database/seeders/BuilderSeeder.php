<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Builder;
use App\Models\City;
use Illuminate\Support\Str;

class BuilderSeeder extends Seeder
{
    public function run(): void
    {
        // Get Karnataka cities
        $bangalore = City::where('name', 'Bangalore')->first();
        $mysore = City::where('name', 'Mysore')->first();
        $mangalore = City::where('name', 'Mangalore')->first();

        $builders = [
            [
                'company_name' => 'Emaar Properties',
                'logo_url' => 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg',
                'description' => 'Emaar Properties is a global property developer with a presence in the Middle East, North Africa, Asia and North America. Headquartered in Dubai, UAE, Emaar is known for creating world-class lifestyle communities.',
                'contact_person_name' => 'Rajesh Kumar',
                'phone' => '+91 80 4567 8900',
                'email' => 'info@emaar-india.com',
                'website' => 'https://www.emaar.com',
                'rera_registration_number' => 'RERA/KA/2020/001',
                'established_year' => 1997,
                'total_projects_completed' => 45,
                'office_address' => 'Emaar Business Park, MG Road',
                'city_id' => $bangalore->id,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'company_name' => 'Prestige Group',
                'logo_url' => 'https://images.pexels.com/photos/30767574/pexels-photo-30767574.jpeg',
                'description' => 'The Prestige Group is one of South India\'s leading property developers with a strong presence in residential, commercial, retail, leisure and hospitality segments.',
                'contact_person_name' => 'Suresh Reddy',
                'phone' => '+91 80 4123 4567',
                'email' => 'contact@prestigeconstructions.com',
                'website' => 'https://www.prestigeconstructions.com',
                'rera_registration_number' => 'RERA/KA/2019/002',
                'established_year' => 1986,
                'total_projects_completed' => 250,
                'office_address' => 'Prestige Towers, Residency Road',
                'city_id' => $bangalore->id,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'company_name' => 'Brigade Group',
                'logo_url' => 'https://images.pexels.com/photos/14391922/pexels-photo-14391922.jpeg',
                'description' => 'Brigade Group is a leading property developer in South India with expertise in residential, commercial, retail, hospitality and education sectors.',
                'contact_person_name' => 'Venkatesh Rao',
                'phone' => '+91 80 6789 0123',
                'email' => 'info@brigadegroup.com',
                'website' => 'https://www.brigadegroup.com',
                'rera_registration_number' => 'RERA/KA/2018/003',
                'established_year' => 1986,
                'total_projects_completed' => 180,
                'office_address' => 'Brigade Gateway, Rajajinagar',
                'city_id' => $bangalore->id,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'company_name' => 'Sobha Limited',
                'logo_url' => 'https://images.pexels.com/photos/16323430/pexels-photo-16323430.jpeg',
                'description' => 'Sobha Limited is one of the fastest growing and foremost backward integrated real estate players in the country.',
                'contact_person_name' => 'Anil Sharma',
                'phone' => '+91 80 2345 6789',
                'email' => 'customercare@sobha.com',
                'website' => 'https://www.sobha.com',
                'rera_registration_number' => 'RERA/KA/2020/004',
                'established_year' => 1995,
                'total_projects_completed' => 95,
                'office_address' => 'Sobha City, Sarjapur Road',
                'city_id' => $bangalore->id,
                'status' => 'active',
                'is_featured' => true,
            ],
            [
                'company_name' => 'Puravankara Limited',
                'logo_url' => 'https://images.pexels.com/photos/10571217/pexels-photo-10571217.jpeg',
                'description' => 'Puravankara Limited is a leading real estate developer with a strong presence across India, known for quality construction and timely delivery.',
                'contact_person_name' => 'Prakash Menon',
                'phone' => '+91 80 8901 2345',
                'email' => 'info@puravankara.com',
                'website' => 'https://www.puravankara.com',
                'rera_registration_number' => 'RERA/KA/2019/005',
                'established_year' => 1975,
                'total_projects_completed' => 75,
                'office_address' => 'Puravankara Towers, Lavelle Road',
                'city_id' => $bangalore->id,
                'status' => 'active',
                'is_featured' => true,
            ],
        ];

        foreach ($builders as $builder) {
            $builder['slug'] = Str::slug($builder['company_name']);
            Builder::create($builder);
        }
    }
}
