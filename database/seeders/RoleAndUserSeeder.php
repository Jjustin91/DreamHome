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
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Salesperson']);
        Role::create(['name' => 'Secretary']);

        // 2. Create YOUR Super Admin Account
        $superAdmin = User::create([
            'name' => 'System Controller',
            'email' => 'admin@dreamhome.test',
            'password' => bcrypt('password123'), 
        ]);
        
        // 3. Assign the role
        $superAdmin->assignRole('Super Admin');
    }
}