<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        
        // Use dot notation to go into the superadmin folder, then the branches folder
        return view('superadmin.branches.index', compact('branches'));
    }

    public function create()
    {
        // Points to resources/views/superadmin/branches/create.blade.php
        return view('superadmin.branches.create');
    }

    public function store(Request $request)
    {
        // 1. Validate the incoming data against the DreamHome database rules
        $validated = $request->validate([
            'branch_no' => 'required|string|max:10|unique:branches,branch_no',
            'street' => 'required|string|max:255',
            'area' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'telephone_no' => 'required|string|max:20',
            'fax_no' => 'nullable|string|max:20',
        ]);

        // 2. Save to PostgreSQL
        Branch::create($validated);

        // 3. Send the user back to the table with a success message
        return redirect()->route('branches.index')->with('success', 'New branch added successfully!');
    }

    public function edit(Branch $branch)
    {
        return view('superadmin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'area' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'telephone_no' => 'required|string|max:20',
            'fax_no' => 'nullable|string|max:20',
        ]);

        $branch->update($validated);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully!');
    }

    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();
            return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Error code 23503 is PostgreSQL's code for a Foreign Key Violation
            if ($e->getCode() == '23503') {
                return redirect()->route('branches.index')->with('error', 'Cannot delete this branch because there are staff or properties assigned to it. Reassign them first.');
            }
            return redirect()->route('branches.index')->with('error', 'An error occurred while trying to delete the branch.');
        }
    }
}
