<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SyncStaffToUsersSeeder extends Seeder
{
    public function run()
    {
        // 1. Get all staff from the HR table
        $allStaff = Staff::all();

        // 2. Loop through every single staff member
        foreach ($allStaff as $staff) {
            
            // 3. Create a user account if they don't already have one
            $user = User::firstOrCreate(
                ['staff_no' => $staff->staff_no],
                [
                    'name' => $staff->first_name . ' ' . $staff->last_name,
                    'password' => Hash::make('password123'), // Default password for all legacy staff
                ]
            );

            // 4. Look at their HR Job Title, and assign the exact matching Spatie Role!
            // Note: We check if the role exists first just in case there's a weird job title in the legacy data
            if (in_array($staff->job_title, ['Manager', 'Supervisor', 'Assistant', 'Salesperson', 'Secretary'])) {
                $user->assignRole($staff->job_title);
            }
        }

        $this->command->info('Success! All legacy staff members now have User accounts and Spatie roles.');
    }
}
