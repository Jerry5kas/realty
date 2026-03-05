<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Bangalore', 'state' => 'Karnataka', 'is_active' => true],
            ['name' => 'Mysore', 'state' => 'Karnataka', 'is_active' => true],
            ['name' => 'Ballari', 'state' => 'Karnataka', 'is_active' => true],
            ['name' => 'Chennai', 'state' => 'Tamil Nadu', 'is_active' => true],
        ];

        foreach ($cities as $city) {
            \App\Models\City::updateOrCreate(
                ['name' => $city['name']],
                $city
            );
        }
    }
}
