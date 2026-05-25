<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyInspectionController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('property_inspections AS i')
            ->join('property_for_rents AS p', 'i.property_no', '=', 'p.property_no')
            ->join('staff AS s', 'i.staff_no', '=', 's.staff_no')
            ->select(
                'i.*', 
                'p.street', 
                'p.city', 
                's.first_name AS staff_first', 
                's.last_name AS staff_last'
            );

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('i.property_no', 'ilike', "%$search%")
                  ->orWhere('p.street', 'ilike', "%$search%")
                  ->orWhere('s.first_name', 'ilike', "%$search%")
                  ->orWhere('s.last_name', 'ilike', "%$search%");
            });
        }

        $inspections = $query->orderBy('i.inspection_date', 'desc')->paginate(10);
        
        return view('inspections.index', compact('inspections'));
    }

    public function create()
    {
        $properties = DB::table('property_for_rents')->get();
        $staff = DB::table('staff')->get();
        return view('inspections.create', compact('properties', 'staff'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_no'     => 'required|exists:property_for_rents,property_no',
            'staff_no'        => 'required|exists:staff,staff_no',
            'inspection_date' => 'required|date',
            'comments'        => 'nullable|string',
        ]);

        // Removed ID generation because your migration uses a composite primary key
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('property_inspections')->insert($data);
        return redirect()->route('inspections.index')->with('success', 'Inspection logged.');
    }

    public function show(string $id)
    {
        // 1. Split the URL string back into our two separate keys using THREE underscores
        [$property_no, $inspection_date] = explode('___', $id);

        // 2. Search using BOTH parts of the composite primary key
        $inspection = DB::table('property_inspections')
            ->where('property_no', $property_no)
            ->where('inspection_date', $inspection_date)
            ->first();
            
        abort_if(!$inspection, 404);

        // 3. Get the associated property and staff details for the view
        $property = DB::table('property_for_rents')->where('property_no', $inspection->property_no)->first();
        $staff = DB::table('staff')->where('staff_no', $inspection->staff_no)->first();

        return view('inspections.show', compact('inspection', 'property', 'staff'));
    }

    public function destroy(string $id)
    {
        // Decode the composite key (PropertyNo___Date)
        [$property_no, $inspection_date] = explode('___', $id);

        DB::table('property_inspections')
            ->where('property_no', $property_no)
            ->where('inspection_date', $inspection_date)
            ->delete();

        return redirect()->route('inspections.index')->with('success', 'Inspection record deleted.');
    }
}