<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class UpdateProjectLocations extends Seeder
{
    public function run()
    {
        $projects = [
            ['id' => 1, 'lat' => 13.0067, 'lng' => 77.5710], // Greencrest Residency - Malleswaram, Bangalore
            ['id' => 2, 'lat' => 12.9897, 'lng' => 77.6387], // Aurea Heights - Baiyyappanahalli, Bangalore
            ['id' => 3, 'lat' => 13.0789, 'lng' => 77.5912], // Palmiera Collective - Jakkur, Bangalore
            ['id' => 4, 'lat' => 12.9784, 'lng' => 77.6408], // Prestige Skyline - Indiranagar, Bangalore
            ['id' => 5, 'lat' => 12.9352, 'lng' => 77.6245], // Brigade Meadows - Koramangala, Bangalore
        ];

        foreach ($projects as $projectData) {
            Project::where('id', $projectData['id'])->update([
                'latitude' => $projectData['lat'],
                'longitude' => $projectData['lng']
            ]);
            
            $this->command->info("Updated project {$projectData['id']} with location data");
        }

        $this->command->info('All projects updated with location data!');
    }
}
