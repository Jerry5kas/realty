<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $profileImages = [
            'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg',
            'https://images.pexels.com/photos/30767574/pexels-photo-30767574.jpeg',
            'https://images.pexels.com/photos/14391922/pexels-photo-14391922.jpeg',
            'https://images.pexels.com/photos/16323430/pexels-photo-16323430.jpeg',
            'https://images.pexels.com/photos/10571217/pexels-photo-10571217.jpeg',
        ];

        $agents = [
            [
                'name' => 'Rajesh Kumar',
                'email' => 'rajesh.kumar@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43210',
                'profile_image' => $profileImages[0],
                'bio' => 'Experienced real estate agent specializing in luxury properties in Bangalore.',
                'properties_sold' => 45,
                'properties_rented' => 23,
                'operating_since' => 2015,
                'buyers_served' => 2500,
                'is_featured' => true,
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya.sharma@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43211',
                'profile_image' => $profileImages[1],
                'bio' => 'Dedicated to helping families find their dream homes in prime locations.',
                'properties_sold' => 38,
                'properties_rented' => 19,
                'operating_since' => 2017,
                'buyers_served' => 3200,
                'is_featured' => true,
            ],
            [
                'name' => 'Amit Patel',
                'email' => 'amit.patel@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43212',
                'profile_image' => $profileImages[2],
                'bio' => 'Commercial property expert with extensive market knowledge.',
                'properties_sold' => 52,
                'properties_rented' => 31,
                'operating_since' => 2012,
                'buyers_served' => 4100,
                'is_featured' => true,
            ],
            [
                'name' => 'Sneha Reddy',
                'email' => 'sneha.reddy@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43213',
                'profile_image' => $profileImages[3],
                'bio' => 'Passionate about connecting people with perfect properties.',
                'properties_sold' => 29,
                'properties_rented' => 15,
                'operating_since' => 2018,
                'buyers_served' => 1800,
                'is_featured' => true,
            ],
            [
                'name' => 'Vikram Singh',
                'email' => 'vikram.singh@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43214',
                'profile_image' => $profileImages[4],
                'bio' => 'Investment property specialist helping clients build wealth through real estate.',
                'properties_sold' => 61,
                'properties_rented' => 28,
                'operating_since' => 2010,
                'buyers_served' => 5000,
                'is_featured' => true,
            ],
            [
                'name' => 'Ananya Iyer',
                'email' => 'ananya.iyer@area24realty.com',
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '+91 98765 43215',
                'profile_image' => null, // Will show initials
                'bio' => 'First-time homebuyer specialist with a focus on affordable housing.',
                'properties_sold' => 34,
                'properties_rented' => 21,
                'operating_since' => 2019,
                'buyers_served' => 2200,
                'is_featured' => true,
            ],
        ];

        foreach ($agents as $agent) {
            User::create($agent);
        }
    }
}
