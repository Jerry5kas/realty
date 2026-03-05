<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            // Get unique developer names from projects
            $developers = DB::table('projects')
                ->select('developer_name', 'developer_description', 'developer_logo')
                ->whereNotNull('developer_name')
                ->groupBy('developer_name', 'developer_description', 'developer_logo')
                ->get();

            foreach ($developers as $developer) {
                // Generate unique slug
                $slug = Str::slug($developer->developer_name);
                $originalSlug = $slug;
                $count = 1;
                
                while (DB::table('builders')->where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                // Create builder record
                $builderId = DB::table('builders')->insertGetId([
                    'company_name' => $developer->developer_name,
                    'slug' => $slug,
                    'description' => $developer->developer_description,
                    'logo_url' => $developer->developer_logo,
                    'status' => 'active',
                    'is_featured' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Update projects with builder_id
                DB::table('projects')
                    ->where('developer_name', $developer->developer_name)
                    ->update(['builder_id' => $builderId]);
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            // Restore developer fields from builders
            $projects = DB::table('projects')
                ->join('builders', 'projects.builder_id', '=', 'builders.id')
                ->select('projects.id', 'builders.company_name', 'builders.description', 'builders.logo_url')
                ->get();

            foreach ($projects as $project) {
                DB::table('projects')
                    ->where('id', $project->id)
                    ->update([
                        'developer_name' => $project->company_name,
                        'developer_description' => $project->description,
                        'developer_logo' => $project->logo_url,
                        'builder_id' => null,
                    ]);
            }

            // Clear builders table
            DB::table('builders')->truncate();
        });
    }
};
