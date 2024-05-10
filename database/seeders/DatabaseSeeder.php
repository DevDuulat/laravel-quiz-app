<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'lecture-list',
            'lecture-create',
            'lecture-edit',
            'lecture-delete',
            'test-list',
            'test-create',
            'test-edit',
            'test-delete'
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        // Assign permissions to admin role
        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);

        // Assign admin role to admin user
        $adminUser->assignRole('Admin');

        // Create regular user
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password')
        ]);

        // Assign user role to regular user
        $regularUser->assignRole('User');
    }
}
