<?php

namespace App\Http\Controllers;

use App\Models\PropertyInspection;
use App\Models\Property;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyInspectionController extends Controller
{
    public function index()
    {
        // Fetch all inspections with their related property and staff data
        $inspections = PropertyInspection::with(['property', 'staff'])->get();
        
        // Data for dropdowns in the modal
        $properties = Property::all();
        $staffMembers = Staff::all();

        // Stats Logic
        $totalInspections = $inspections->count();
        $recentInspection = PropertyInspection::orderBy('inspection_date', 'desc')->first();
        
        // Monthly stats calculation
        $inspectionsThisMonth = PropertyInspection::whereMonth('inspection_date', Carbon::now()->month)
                                ->whereYear('inspection_date', Carbon::now()->year)
                                ->count();

        return view('inspections.index', compact(
            'inspections', 
            'properties', 
            'staffMembers',
            'totalInspections',
            'recentInspection',
            'inspectionsThisMonth'
        ));
    }

    public function store(Request $request)
    {
        // 1. Basic Field Validation
        $validated = $request->validate([
            // PostgreSQL fix: lowercase table name
            'property_no'     => 'required|exists:property_for_rent,property_no',
            'staff_no'        => 'required|exists:staff,staff_no',
            'inspection_date' => 'required|date',
            'comments'        => 'nullable|string',
        ]);

        // 2. Composite Key Validation (CRASH PREVENTION)
        // Since the database blocks duplicate (property_no + inspection_date)
        $alreadyExists = PropertyInspection::where('property_no', $request->property_no)
            ->where('inspection_date', $request->inspection_date)
            ->exists();

        if ($alreadyExists) {
            return redirect()->back()
                ->withInput() // Prevents the user from losing their comments
                ->withErrors([
                    'inspection_date' => 'A report for this property on this date already exists.'
                ]);
        }

        // 3. Save if check passed
        PropertyInspection::create($validated);

        return redirect()->route('inspections.index')->with('success', 'Inspection report saved!');
    }
}