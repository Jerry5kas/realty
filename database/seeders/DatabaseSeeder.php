<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            PropertyTypeSeeder::class,
            AmenitySeeder::class,
            PropertyFeatureSeeder::class,
            BuilderSeeder::class,
            ProjectSeeder::class,
            PropertySeeder::class,
            BannerSeeder::class,
            AgentSeeder::class,
            CollectionSeeder::class,
        ]);
    }
}
