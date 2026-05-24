<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyViewingController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('property_viewings AS v')
            ->join('property_for_rents AS p', 'v.property_no', '=', 'p.property_no')
            ->join('renter_details AS r', 'v.renter_no', '=', 'r.renter_no')
            ->join('staff AS s', 'v.staff_no', '=', 's.staff_no')
            ->select('v.*', 'p.street', 'p.city', 'r.first_name AS renter_first', 'r.last_name AS renter_last', 's.first_name AS staff_first', 's.last_name AS staff_last');

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('v.viewing_no', 'ilike', "%$search%")
                  ->orWhere('p.property_no', 'ilike', "%$search%")
                  ->orWhere('p.street', 'ilike', "%$search%")
                  ->orWhere('p.city', 'ilike', "%$search%")
                  ->orWhere('r.first_name', 'ilike', "%$search%")
                  ->orWhere('r.last_name', 'ilike', "%$search%")
                  ->orWhere('s.first_name', 'ilike', "%$search%")
                  ->orWhere('s.last_name', 'ilike', "%$search%")
                  // NEW: Converts date to searchable text including month names
                  ->orWhereRaw("TO_CHAR(v.viewing_date, 'YYYY-MM-DD FMMonth Mon DD, YYYY') ILIKE ?", ["%$search%"]);
            });
        }

        $viewings = $query->orderBy('v.viewing_date', 'desc')->paginate(10);
        return view('viewings.index', compact('viewings'));
    }

    public function create()
    {
        $properties = DB::table('property_for_rents')->get();
        $clients = DB::table('renter_details')->get();
        $staff = DB::table('staff')->get(); // Added staff for the viewing
        
        return view('viewings.create', compact('properties', 'clients', 'staff'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_no'  => 'required|exists:property_for_rents,property_no',
            'renter_no'    => 'required|exists:renter_details,renter_no',
            'staff_no'     => 'required|exists:staff,staff_no', // Required by your migration
            'viewing_date' => 'required|date',
            'feedback'     => 'nullable|string|max:255', // Changed to feedback
        ]);

        $last = DB::table('property_viewings')->orderBy('viewing_no', 'desc')->first();
        $num = $last ? ((int) preg_replace('/\D/', '', $last->viewing_no)) + 1 : 1;
        $data['viewing_no'] = 'VW' . str_pad($num, 3, '0', STR_PAD_LEFT);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('property_viewings')->insert($data);
        return redirect()->route('viewings.index')->with('success', 'Viewing scheduled successfully.');
    }

    public function edit(string $id)
    {
        $viewing = DB::table('property_viewings')->where('viewing_no', $id)->first();
        abort_if(!$viewing, 404);
        return view('viewings.edit', compact('viewing'));
    }

    public function update(Request $request, string $id)
    {
        DB::table('property_viewings')->where('viewing_no', $id)->update([
            'feedback' => $request->validate(['feedback' => 'nullable|string|max:255'])['feedback'],
            'updated_at' => now(),
        ]);
        return redirect()->route('viewings.index')->with('success', 'Viewing feedback logged.');
    }

    public function destroy(string $id)
    {
        DB::table('property_viewings')->where('viewing_no', $id)->delete();
        return redirect()->route('viewings.index')->with('success', 'Viewing record deleted.');
    }
}