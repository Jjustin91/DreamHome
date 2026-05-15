<?php

namespace App\Http\Controllers;

use App\Models\LeaseAgreement;
use App\Models\Property;
use App\Models\Renter;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaseAgreementController extends Controller
{
    public function index()
    {
        // 1. Fetch Leases with relationships
        $leases = LeaseAgreement::with(['property', 'renter', 'staff'])->get();

        // 2. SMART AUTO-ID LOGIC (Step 1 implementation)
        // Looks for IDs starting with 'L' and finds the highest number
        $lastLease = LeaseAgreement::where('lease_no', 'like', 'L%')
            ->orderBy('lease_no', 'desc')
            ->first();

        if ($lastLease) {
            // Strip the 'L', add 1, and re-attach 'L' (e.g., L100 -> L101)
            $number = (int) substr($lastLease->lease_no, 1);
            $nextLeaseID = 'L' . ($number + 1);
        } else {
            $nextLeaseID = 'L101'; // Default start if table is empty
        }

        // 3. Fetch data for dropdowns
        $properties = Property::all();
        $renters = Renter::all();
        $staffMembers = Staff::all();

        // 4. Dashboard Calculations
        $totalActiveLeases = $leases->count();
        $totalMonthlyRevenue = $leases->sum('monthly_rent');
        $pendingDeposits = $leases->where('deposit_paid', false)->count();

        return view('leases.index', compact(
            'leases', 
            'nextLeaseID', // Passing the auto-generated ID
            'properties', 
            'renters', 
            'staffMembers',
            'totalActiveLeases',
            'totalMonthlyRevenue',
            'pendingDeposits'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lease_no'       => 'required|unique:lease_agreements,lease_no',
            // POSTGRES FIX: Table names forced to lowercase for validation
            'property_no'    => 'required|exists:property_for_rent,property_no',
            'renter_no'      => 'required|exists:renter_details,renter_no',
            'staff_no'       => 'required|exists:staff,staff_no',
            'monthly_rent'   => 'required|numeric',
            'payment_method' => 'required|string',
            'deposit_amount' => 'required|numeric',
            'deposit_paid'   => 'nullable', 
            'rent_start'     => 'required|date',
            // rent_finish remains nullable to allow for 'Ongoing' leases
            'rent_finish'    => 'nullable|date|after:rent_start',
        ]);

        // STEP 1 FIX: Logic for 'Ongoing' leases
        // If the user checks the 'Ongoing' box (we will add this to the UI), 
        // we force rent_finish to be NULL regardless of what's in the date picker.
        if ($request->has('is_ongoing')) {
            $validated['rent_finish'] = null;
        }

        // Checkbox handling for deposit
        $validated['deposit_paid'] = $request->has('deposit_paid');

        LeaseAgreement::create($validated);

        return redirect()->route('leases.index')->with('success', 'New lease agreement created!');
    }
}