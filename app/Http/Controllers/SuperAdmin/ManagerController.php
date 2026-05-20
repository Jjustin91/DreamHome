<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Staff::where('job_title', 'Manager')->get();
        return view('superadmin.managers.index', compact('managers'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('superadmin.managers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_no' => 'required|string|max:5|unique:staff,staff_no|unique:users,staff_no',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:255', // <-- 1. ADD THIS LINE
            'branch_no' => 'required|exists:branches,branch_no',
            'telephone_no' => 'required|string|max:20',
            'sex' => 'required|in:M,F',
            'date_of_birth' => 'required|date',
            'nin' => 'required|string|max:20',
            'salary' => 'required|numeric',
        ]);

        // 1. Create the Security Account (Login)
        $user = User::create([
            'staff_no' => $validated['staff_no'],
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'password' => Hash::make('password123'), 
        ]);

        // 2. Assign Spatie Role automatically
        $user->assignRole('Manager');

        // 3. Create the HR Record
        Staff::create([
            'staff_no' => $validated['staff_no'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'address' => $validated['address'], // <-- 2. ADD THIS LINE
            'branch_no' => $validated['branch_no'],
            'telephone_no' => $validated['telephone_no'],
            'sex' => $validated['sex'],
            'date_of_birth' => $validated['date_of_birth'],
            'nin' => $validated['nin'],
            'salary' => $validated['salary'],
            'job_title' => 'Manager',
            'date_joined' => now(),
            'manager_start_date' => now(),
        ]);

        return redirect()->route('managers.index')->with('success', 'Manager assigned and system access granted.');
    }

    public function edit(Staff $manager)
    {
        $branches = Branch::all();
        return view('superadmin.managers.edit', compact('manager', 'branches'));
    }

    public function update(Request $request, Staff $manager)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:255', // <-- 1. ADD THIS LINE
            'branch_no' => 'required|exists:branches,branch_no',
            'telephone_no' => 'required|string|max:20',
            'salary' => 'required|numeric',
        ]);

        // 1. Update the HR Record
        $manager->update($validated);

        // 2. Keep their User security account name in sync!
        $user = User::where('staff_no', $manager->staff_no)->first();
        if ($user) {
            $user->update([
                'name' => $validated['first_name'] . ' ' . $validated['last_name']
            ]);
        }

        return redirect()->route('managers.index')->with('success', 'Manager profile updated.');
    }
}
