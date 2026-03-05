<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Delete old users that are no longer needed
        User::whereNotIn('email', [
            'admin@realty.com',
            'owner@realty.com',
            'agent@realty.com',
            'viewer@realty.com'
        ])->delete();

        $this->command->info('Old users cleaned up!');

        // Seed demo users for each role
        $users = [
            [
                'name' => 'System Admin',
                'email' => 'admin@realty.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin', // Keep old role field for backward compatibility
                'new_role' => 'admin', // New RBAC role
            ],
            [
                'name' => 'Property Owner',
                'email' => 'owner@realty.com',
                'password' => Hash::make('12345678'),
                'role' => 'owner',
                'new_role' => 'owner',
            ],
            [
                'name' => 'Real Estate Agent',
                'email' => 'agent@realty.com',
                'password' => Hash::make('12345678'),
                'role' => 'agent',
                'new_role' => 'agent',
            ],
            [
                'name' => 'Property Viewer',
                'email' => 'viewer@realty.com',
                'password' => Hash::make('12345678'),
                'role' => 'viewer',
                'new_role' => 'viewer',
            ],
        ];

        foreach ($users as $userData) {
            $newRole = $userData['new_role'];
            unset($userData['new_role']);

            // Create or update user
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            // Assign role from new role system
            $role = Role::where('slug', $newRole)->first();
            if ($role) {
                // Remove all existing roles first
                $user->roles()->detach();
                // Assign new role
                $user->assignRole($role);
                $this->command->info("Assigned role '{$role->name}' to {$user->email}");
            }
        }

        $this->command->info('Users seeded and synced with roles successfully!');
    }
}
