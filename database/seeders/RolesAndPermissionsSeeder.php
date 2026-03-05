<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions by module
        $permissions = [
            // Properties
            ['name' => 'View Properties', 'slug' => 'properties.view', 'module' => 'properties'],
            ['name' => 'Create Properties', 'slug' => 'properties.create', 'module' => 'properties'],
            ['name' => 'Edit Properties', 'slug' => 'properties.edit', 'module' => 'properties'],
            ['name' => 'Delete Properties', 'slug' => 'properties.delete', 'module' => 'properties'],

            // Projects
            ['name' => 'View Projects', 'slug' => 'projects.view', 'module' => 'projects'],
            ['name' => 'Create Projects', 'slug' => 'projects.create', 'module' => 'projects'],
            ['name' => 'Edit Projects', 'slug' => 'projects.edit', 'module' => 'projects'],
            ['name' => 'Delete Projects', 'slug' => 'projects.delete', 'module' => 'projects'],

            // Transactions
            ['name' => 'View Transactions', 'slug' => 'transactions.view', 'module' => 'transactions'],
            ['name' => 'Create Transactions', 'slug' => 'transactions.create', 'module' => 'transactions'],
            ['name' => 'Edit Transactions', 'slug' => 'transactions.edit', 'module' => 'transactions'],
            ['name' => 'Delete Transactions', 'slug' => 'transactions.delete', 'module' => 'transactions'],

            // Events/Calendar
            ['name' => 'View Events', 'slug' => 'events.view', 'module' => 'events'],
            ['name' => 'Create Events', 'slug' => 'events.create', 'module' => 'events'],
            ['name' => 'Edit Events', 'slug' => 'events.edit', 'module' => 'events'],
            ['name' => 'Delete Events', 'slug' => 'events.delete', 'module' => 'events'],

            // Builders
            ['name' => 'View Builders', 'slug' => 'builders.view', 'module' => 'builders'],
            ['name' => 'Create Builders', 'slug' => 'builders.create', 'module' => 'builders'],
            ['name' => 'Edit Builders', 'slug' => 'builders.edit', 'module' => 'builders'],
            ['name' => 'Delete Builders', 'slug' => 'builders.delete', 'module' => 'builders'],

            // Cities
            ['name' => 'View Cities', 'slug' => 'cities.view', 'module' => 'cities'],
            ['name' => 'Create Cities', 'slug' => 'cities.create', 'module' => 'cities'],
            ['name' => 'Edit Cities', 'slug' => 'cities.edit', 'module' => 'cities'],
            ['name' => 'Delete Cities', 'slug' => 'cities.delete', 'module' => 'cities'],

            // Amenities
            ['name' => 'View Amenities', 'slug' => 'amenities.view', 'module' => 'amenities'],
            ['name' => 'Create Amenities', 'slug' => 'amenities.create', 'module' => 'amenities'],
            ['name' => 'Edit Amenities', 'slug' => 'amenities.edit', 'module' => 'amenities'],
            ['name' => 'Delete Amenities', 'slug' => 'amenities.delete', 'module' => 'amenities'],

            // Features
            ['name' => 'View Features', 'slug' => 'features.view', 'module' => 'features'],
            ['name' => 'Create Features', 'slug' => 'features.create', 'module' => 'features'],
            ['name' => 'Edit Features', 'slug' => 'features.edit', 'module' => 'features'],
            ['name' => 'Delete Features', 'slug' => 'features.delete', 'module' => 'features'],

            // Property Types
            ['name' => 'View Property Types', 'slug' => 'property-types.view', 'module' => 'property-types'],
            ['name' => 'Create Property Types', 'slug' => 'property-types.create', 'module' => 'property-types'],
            ['name' => 'Edit Property Types', 'slug' => 'property-types.edit', 'module' => 'property-types'],
            ['name' => 'Delete Property Types', 'slug' => 'property-types.delete', 'module' => 'property-types'],

            // Banners
            ['name' => 'View Banners', 'slug' => 'banners.view', 'module' => 'banners'],
            ['name' => 'Create Banners', 'slug' => 'banners.create', 'module' => 'banners'],
            ['name' => 'Edit Banners', 'slug' => 'banners.edit', 'module' => 'banners'],
            ['name' => 'Delete Banners', 'slug' => 'banners.delete', 'module' => 'banners'],

            // Media Assets
            ['name' => 'View Media Assets', 'slug' => 'media-assets.view', 'module' => 'media-assets'],
            ['name' => 'Create Media Assets', 'slug' => 'media-assets.create', 'module' => 'media-assets'],
            ['name' => 'Edit Media Assets', 'slug' => 'media-assets.edit', 'module' => 'media-assets'],
            ['name' => 'Delete Media Assets', 'slug' => 'media-assets.delete', 'module' => 'media-assets'],

            // Users & Roles
            ['name' => 'View Users', 'slug' => 'users.view', 'module' => 'users'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'module' => 'users'],
            ['name' => 'Edit Users', 'slug' => 'users.edit', 'module' => 'users'],
            ['name' => 'Delete Users', 'slug' => 'users.delete', 'module' => 'users'],

            ['name' => 'View Roles', 'slug' => 'roles.view', 'module' => 'roles'],
            ['name' => 'Create Roles', 'slug' => 'roles.create', 'module' => 'roles'],
            ['name' => 'Edit Roles', 'slug' => 'roles.edit', 'module' => 'roles'],
            ['name' => 'Delete Roles', 'slug' => 'roles.delete', 'module' => 'roles'],

            // Owners (CRM Module - Coming Soon)
            ['name' => 'View Owners', 'slug' => 'owners.view', 'module' => 'owners'],
            ['name' => 'Create Owners', 'slug' => 'owners.create', 'module' => 'owners'],
            ['name' => 'Edit Owners', 'slug' => 'owners.edit', 'module' => 'owners'],
            ['name' => 'Delete Owners', 'slug' => 'owners.delete', 'module' => 'owners'],

            // Settings
            ['name' => 'View Settings', 'slug' => 'settings.view', 'module' => 'settings'],
            ['name' => 'Edit Settings', 'slug' => 'settings.edit', 'module' => 'settings'],

            // Reports
            ['name' => 'View Reports', 'slug' => 'reports.view', 'module' => 'reports'],
            ['name' => 'Export Reports', 'slug' => 'reports.export', 'module' => 'reports'],
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        // Delete old roles that are no longer needed
        Role::whereIn('slug', ['super-admin', 'manager'])->delete();

        // Define roles with clear hierarchy
        $roles = [
            // System Admin - Only created via seeder, cannot register
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'System administrator with full access to all features including users, roles, and settings',
                'permissions' => Permission::all()->pluck('id')->toArray(),
            ],
            
            // Registerable Roles - Users can register with these roles
            [
                'name' => 'Owner',
                'slug' => 'owner',
                'description' => 'Property owner with full access to manage properties, projects, transactions, and content',
                'permissions' => Permission::whereIn('module', [
                    'properties', 'projects', 'transactions', 'events', 
                    'builders', 'cities', 'amenities', 'features', 'property-types',
                    'banners', 'media-assets', 'owners', 'reports'
                ])->pluck('id')->toArray(),
            ],
            [
                'name' => 'Agent',
                'slug' => 'agent',
                'description' => 'Real estate agent who can manage properties, create transactions, and schedule events',
                'permissions' => Permission::whereIn('slug', [
                    'properties.view', 'properties.create', 'properties.edit',
                    'projects.view',
                    'transactions.view', 'transactions.create', 'transactions.edit',
                    'events.view', 'events.create', 'events.edit',
                    'builders.view', 'cities.view', 'amenities.view', 'features.view', 'property-types.view',
                    'media-assets.view', 'media-assets.create',
                    'owners.view',
                    'reports.view'
                ])->pluck('id')->toArray(),
            ],
            [
                'name' => 'Viewer',
                'slug' => 'viewer',
                'description' => 'Read-only access to view properties, projects, and listings',
                'permissions' => Permission::where('slug', 'like', '%.view')->pluck('id')->toArray(),
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);

            $role = Role::firstOrCreate(
                ['slug' => $roleData['slug']],
                $roleData
            );

            $role->syncPermissions($permissions);
        }

        $this->command->info('Roles and permissions seeded successfully!');
    }
}
