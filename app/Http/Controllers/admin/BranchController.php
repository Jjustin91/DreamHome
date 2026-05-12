<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('branch');

        // Search Logic
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            
            // Use a closure to group the OR statements
            $query->where(function($q) use ($searchTerm) {
                $q->where('branch_no', 'ILIKE', "%{$searchTerm}%")
                ->orWhere('city', 'ILIKE', "%{$searchTerm}%")
                ->orWhere('street', 'ILIKE', "%{$searchTerm}%")
                ->orWhere('postcode', 'ILIKE', "%{$searchTerm}%");
            });
        }

        // Sort by Branch ID and get results
        $branches = $query->orderBy('branch_no', 'asc')->get();

        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Add telephone_no to validation
        $validated = $request->validate([
            'street'       => 'required|string|max:50',
            'city'         => 'required|string|max:30',
            'postcode'     => 'required|string|max:10',
            'telephone_no' => 'required|string|max:20', // Add this
        ]);

        // 2. Your Auto-ID logic (stays the same)
        $lastBranch = DB::table('branch')->orderBy('branch_no', 'desc')->first();
        if ($lastBranch) {
            $number = (int) substr($lastBranch->branch_no, 1);
            $newId = 'B' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newId = 'B001';
        }

        // 3. Insert into Database (Include telephone_no)
        DB::table('branch')->insert([
            'branch_no'    => $newId,
            'street'       => $validated['street'],
            'city'         => $validated['city'],
            'postcode'     => $validated['postcode'],
            'telephone_no' => $validated['telephone_no'], // Add this
        ]);

        return redirect()->route('admin.branches.index')
            ->with('success', "Branch $newId created successfully!");
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 1. Fetch branch details
        $branch = DB::table('branch')->where('branch_no', $id)->first();

        if (!$branch) {
            return redirect()->route('admin.branches.index')->with('error', 'Branch not found.');
        }

        // 2. Fetch staff currently at this branch
        $staffs = DB::table('staff')
            ->where('branch_no', $id)
            ->orderBy('staff_no', 'asc')
            ->get();

        // 3. Fetch staff available for assignment (different branch or no branch)
        $availableStaff = DB::table('staff')
            ->where('branch_no', '!=', $id)
            ->orWhereNull('branch_no')
            ->orderBy('last_name', 'asc')
            ->get();

        return view('admin.branches.show', compact('branch', 'staffs', 'availableStaff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branch = DB::table('branch')->where('branch_no', $id)->first();

        if (!$branch) {
            return redirect()->route('admin.branches.index')->with('error', 'Branch not found.');
        }

        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::table('branch')->where('branch_no', $id)->update([
            'street'   => $request->street,
            'city'     => $request->city,
            'postcode' => $request->postcode,
        ]);


        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Explicitly use 'branch_no' instead of the default 'id'
            $deleted = DB::table('branch')->where('branch_no', $id)->delete();

            if ($deleted) {
                return redirect()->route('admin.branches.index')
                    ->with('success', "Branch $id has been successfully removed.");
            }

            return redirect()->route('admin.branches.index')
                ->with('error', "Branch not found.");

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle Foreign Key Violations (e.g., staff or properties linked to this branch)
            if ($e->getCode() == "23503") {
                return redirect()->route('admin.branches.index')
                    ->with('error', "Cannot delete branch. Please reassign staff and properties linked to $id first.");
            }

            return redirect()->route('admin.branches.index')
                ->with('error', "An unexpected error occurred.");
        }
    }

    public function assignStaff(Request $request, $id)
    {
        $request->validate([
            'staff_no' => 'required'
        ]);

        // Update the staff record to link them to this branch
        DB::table('staff')
            ->where('staff_no', $request->staff_no)
            ->update(['branch_no' => $id]);

        return back()->with('success', 'Staff member assigned successfully!');
    }
}
