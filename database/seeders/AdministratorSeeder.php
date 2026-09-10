<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the role
        $role = Role::firstOrCreate(['name' => 'administrator', 'guard_name' => 'web']);

        // 2. Give it every permission that currently exists
        $role->syncPermissions(Permission::all());

        // 3. Create the admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'), // change before production
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 4. Attach the role to the user
        $user->assignRole($role);
    }
}
