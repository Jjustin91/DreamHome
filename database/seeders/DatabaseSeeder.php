<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Run your roles and admin account first
       $this->call([
            RoleAndUserSeeder::class,
        ]);

        // 2. Execute the raw SQL file to seed the thousands of case study records
        $sqlPath = database_path('seeders/legacy_data.sql');
        
        if (file_exists($sqlPath)) {
            DB::unprepared(file_get_contents($sqlPath));
            $this->command->info('Legacy SQL data imported successfully!');
        } else {
            $this->command->error('Could not find the legacy_data.sql file.');
        }
    }
}
