<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // User::factory(10)->create();

        User::create([
            
            'name' => 'Zyra Nadine Flores',
            'email' => 'FloresZN@dreamhome.com',
            'password' => Hash::make('password123'), // Your default password
            'job_title' => 'Manager', // Set the job title for the admin user
        ]);
    }
}
