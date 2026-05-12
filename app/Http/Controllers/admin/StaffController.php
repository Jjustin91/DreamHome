<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check for Admin role
        if (auth()->user()->job_title !== 'Admin') {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        $query = DB::table('staff')
            ->leftJoin('branch', 'staff.branch_no', '=', 'branch.branch_no')
            ->select(
                'staff.staff_no', 
                'staff.first_name', 
                'staff.last_name', 
                'staff.telephone_no', 
                'staff.job_title', 
                'staff.branch_no',
                'staff.image_path', 
                'branch.city as branch_city'
            );

            $staffs = $query->orderBy('staff.staff_no', 'asc')->get();

        // Search logic 
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('staff.first_name', 'ILIKE', "%{$searchTerm}%")
                ->orWhere('staff.last_name', 'ILIKE', "%{$searchTerm}%")
                ->orWhere('staff.staff_no', 'ILIKE', "%{$searchTerm}%");
            });
        }

        $staffs = $query->get();

        return view('admin.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // 1. RBAC: Check Admin access
        if (auth()->user()->job_title !== 'Admin') {
            return redirect('/dashboard')->with('error', 'Unauthorized access.');
        }

        // 2. Capture the branch ID from the URL (if coming from a Branch Show page)
        $preSelectedBranch = $request->query('branch_no');

        // 3. Fetch all branches for the dropdown
        $branches = DB::table('branch')->orderBy('city', 'asc')->get();

        // 4. Pass the data to the view
        return view('admin.staff.create', compact('branches', 'preSelectedBranch'));
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'required|string|max:250',
            'telephone_no' => 'required|string|max:20',
            'sex' => 'required|string|max:1',
            'date_of_birth' => 'required|date',
            'nin' => 'required|string|max:20',
            'job_title' => 'required|string|max:50',
            'salary' => 'required|numeric',
            'branch_no' => 'nullable|string|max:10',

            'image' => 'nullable|image|max:2048',
            'car_allowance' => 'nullable|numeric',
            'bonus_payment' => 'nullable|numeric',
            'typing_speed' => 'nullable|integer',
            'supervisor_no' => 'nullable|string|max:5',

            // Next of Kin Validation
            'nok_full_name' => 'required|string|max:100',
            'nok_relationship' => 'required|string|max:50',
            'nok_telephone_no' => 'required|string|max:20',
            'nok_address' => 'required|string|max:255',
        ]);

        // 2.Auto-Incrementing Staff ID 
        $lastStaff = DB::table('staff')->orderBy('staff_no', 'desc')->first();
        if (!$lastStaff) {
            $newStaffNo = 'S001';
        } else {
            $number = (int) substr($lastStaff->staff_no, 1);
            $newStaffNo = 'S' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        }

        // 3. Handle Photo Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('staff_photos', 'public');
        }
        
        // 4. Database Transaction to save to multiple tables
        DB::transaction(function () use ($request, $newStaffNo, $imagePath) {
            
            // Insert into 'staff' table
            DB::table('staff')->insert([
                'staff_no' => $newStaffNo,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'nin' => $request->nin,
                'job_title' => $request->job_title,
                'salary' => $request->salary,
                'car_allowance' => $request->job_title === 'Manager' ? $request->car_allowance : null,
                'bonus_payment' => $request->job_title === 'Manager' ? $request->bonus_payment : null,
                'typing_speed' => $request->job_title === 'Secretary' ? $request->typing_speed : null,
                'supervisor_no' => $request->supervisor_no,
                'telephone_no' => $request->telephone_no,
                'address' => $request->address,
                'branch_no' => $request->branch_no,
                'date_joined'   => now()->format('Y-m-d'),
                'image_path' => $imagePath
            ]);

            // Insert into 'next_of_kin' table
            DB::table('next_of_kin')->insert([
                'staff_no'     => $newStaffNo,
                'full_name'    => $request->nok_full_name, // DB column is 'full_name'
                'relationship' => $request->nok_relationship, // DB column is 'relationship'
                'address'      => $request->nok_address,      // DB column is 'address'
                'telephone_no' => $request->nok_telephone_no, // DB column is 'telephone_no'
            ]);
        });

        return redirect()->route('admin.staff.index')->with('success', "Staff Member $newStaffNo and their Next of Kin have been registered.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       // Fetch staff with branch details
        $staff = DB::table('staff')
            ->leftJoin('branch', 'staff.branch_no', '=', 'branch.branch_no')
            ->where('staff.staff_no', $id)
            ->select('staff.*', 'branch.city as branch_city', 'branch.street as branch_street')
            ->first();

        if (!$staff) {
            return redirect()->route('admin.staff.index')->with('error', 'Staff not found.');
        }

        // 2. Fetch Managed Properties (for Salespersons/Managers)
        $properties = DB::table('property_for_rent')->where('staff_no', $id)->get();

        // 3. Fetch Next of Kin
        $nok = DB::table('next_of_kin')->where('staff_no', $id)->first();

        // 4. Return EVERYTHING in one go
        return view('admin.staff.show', compact('staff', 'nok', 'properties'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (auth()->user()->job_title !== 'Admin') {
            return redirect()->route('dashboard')->with('error', 'Access Denied.');
        }

        // 2. Fetch Staff Details
        // Using first() because staff_no is unique
        $staff = DB::table('staff')->where('staff_no', $id)->first();

        // 3. Check if staff exists to prevent 404 errors
        if (!$staff) {
            return redirect()->route('admin.staff.index')->with('error', 'Staff member not found.');
        }

        // 4. Fetch Next of Kin Details
        // Linked via staff_no foreign key
        $nok = DB::table('next_of_kin')->where('staff_no', $id)->first();

        // 5. Fetch Branches for the dropdown menu
        $branches = DB::table('branch')->orderBy('branch_no')->get();

        // 6. Pass everything to the view
        return view('admin.staff.edit', compact('staff', 'nok', 'branches'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'sex' => 'required|string|max:1',
            'date_of_birth' => 'required|date',
            'nin' => 'required|string|max:20',
            'job_title' => 'required|string',
            'salary' => 'required|numeric',
            'telephone_no' => 'required|string|max:20',
            'address' => 'required|string|max:250',
            'branch_no' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            // Next of Kin
            'nok_full_name' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_address' => 'required|string',
            'nok_telephone_no' => 'required|string',
        ]);

        // 2. Fetch existing staff to handle the image
        $staffMember = DB::table('staff')->where('staff_no', $id)->first();
        $imagePath = $staffMember->image_path;

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('staff', 'public');
        }

        // 4. Update Tables using a Transaction
        DB::transaction(function () use ($request, $id, $imagePath) {
            
            // Update 'staff' table
            DB::table('staff')->where('staff_no', $id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
                'nin' => $request->nin,
                'job_title' => $request->job_title,
                'salary' => $request->salary,
                'car_allowance' => $request->job_title === 'Manager' ? $request->car_allowance : null,
                'bonus_payment' => $request->job_title === 'Manager' ? $request->bonus_payment : null,
                'typing_speed' => $request->job_title === 'Secretary' ? $request->typing_speed : null,
                'supervisor_no' => $request->supervisor_no,
                'telephone_no' => $request->telephone_no,
                'address' => $request->address,
                'branch_no' => $request->branch_no,
                'image_path' => $imagePath,                                                                                     
            ]);

            // Update 'next_of_kin' table
            DB::table('next_of_kin')->where('staff_no', $id)->update([
                'full_name' => $request->nok_full_name,
                'relationship' => $request->nok_relationship,
                'address' => $request->nok_address,
                'telephone_no' => $request->nok_telephone_no,
            ]);
        });

        // 5. Redirect back to the index with success message
        return redirect()->route('admin.staff.index')->with('success', 'Staff details and Next of Kin updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */ 
    public function destroy($staff_no)
    {
        try {
            // ...the name here in the 'use' part
            DB::transaction(function () use ($staff_no) { 
                
                // 1. Delete Child Records
                DB::table('next_of_kin')->where('staff_no', $staff_no)->delete();

                // 2. Unlink from Properties
                DB::table('property_for_rent')
                    ->where('staff_no', $staff_no)
                    ->update(['staff_no' => null]);

                // 3. Delete Parent Record
                DB::table('staff')->where('staff_no', $staff_no)->delete();
            });

            return redirect()->route('admin.staff.index')
                ->with('success', "Staff member $staff_no deleted successfully.");

        } catch (\Exception $e) {
            return redirect()->route('admin.staff.index')
                ->with('error', "Deletion failed: " . $e->getMessage());
        }
    }
}
