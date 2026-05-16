<?php

namespace Database\Seeders; // <-- 1. Add this line right here!

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndUserSeeder extends Seeder
{
    public function run()
    {
        // 1. Create the Roles based on your Matrix
        Role::firstOrCreate(['name' => 'Super Admin']);
        Role::firstOrCreate(['name' => 'Manager']);
        Role::firstOrCreate(['name' => 'Supervisor']);
        Role::firstOrCreate(['name' => 'Salesperson']);
        Role::firstOrCreate(['name' => 'Secretary']);

        // 2. Create YOUR Super Admin Account
        $superAdmin = User::firstOrCreate(
            ['staff_no' => 'ADMIN'], // 1. It checks if this staff_no exists
            [
                // 2. If it DOES NOT exist, it creates it with these details
                'name' => 'System Controller',
                'password' => bcrypt('password123'), 
            ]
        );
        
        // 3. Assign the role
        $superAdmin->assignRole('Super Admin');
    }
}