<?php

namespace App\Http\Controllers;

use App\Models\PropertyViewing;
use App\Models\Renter;
use App\Models\Property; 
use App\Models\Staff; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertyViewingController extends Controller
{
    public function index()
    {
        // 1. Fetch main Viewings with relationships pre-loaded (Performance fix)
        $viewings = PropertyViewing::with(['property', 'renter'])->get();
        
        // 2. Smart Auto-ID Logic (Calculates the next VW### number)
        $lastViewing = PropertyViewing::orderBy('viewing_no', 'desc')->first();
        if ($lastViewing) {
            $currentNumber = (int) substr($lastViewing->viewing_no, 2);
            $nextID = 'VW' . str_pad($currentNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextID = 'VW001';
        }

        // 3. Fetch data needed for the Record Form dropdowns
        $renters = Renter::all();
        $properties = Property::all();
        $staffMembers = Staff::all();

        // 4. Calculate Dashboard Stats
        $viewingsToday = PropertyViewing::whereDate('viewing_date', Carbon::today())->count();
        
        $mostViewed = PropertyViewing::select('property_no', DB::raw('count(*) as total'))
            ->groupBy('property_no')
            ->orderBy('total', 'desc')
            ->first();
        
        $mostViewedID = $mostViewed ? $mostViewed->property_no : 'N/A';
        $totalViews = $viewings->count();

        // 5. Send everything to the Blade file
        return view('viewings.index', compact(
            'viewings', 
            'nextID', 
            'renters', 
            'properties', 
            'staffMembers',
            'viewingsToday',
            'mostViewedID',
            'totalViews'
        ));
    }

    public function store(Request $request)
    {
        // 6. Validate and Save (using lowercase table names for PostgreSQL compatibility)
        $validated = $request->validate([
            'viewing_no'   => 'required|unique:property_viewings,viewing_no',
            'property_no'  => 'required|exists:property_for_rent,property_no',
            'renter_no'    => 'required|exists:renter_details,renter_no',
            'staff_no'     => 'required|exists:staff,staff_no',
            'viewing_date' => 'required|date',
            'feedback'     => 'nullable|string|max:255',
        ]);

        PropertyViewing::create($validated);

        return redirect()->route('viewings.index')->with('success', 'Viewing recorded successfully!');
    }
}