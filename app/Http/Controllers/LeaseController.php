<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaseController extends Controller
{
    public function index(Request $request)
    {
        // UPDATED: Using lease_agreements table
        $query = DB::table('lease_agreements AS l')
            ->join('property_for_rents AS p', 'l.property_no', '=', 'p.property_no')
            ->join('renter_details AS r', 'l.renter_no', '=', 'r.renter_no')
            ->select('l.*', 'p.street', 'p.city', 'r.first_name', 'r.last_name');

        if ($s = $request->search) {
            $query->where('l.lease_no', 'ilike', "%$s%")
                  ->orWhere('r.last_name', 'ilike', "%$s%");
        }

        $leases = $query->orderBy('l.rent_start', 'desc')->paginate(10);
        return view('leases.index', compact('leases'));
    }

    public function create()
    {
        $properties = DB::table('property_for_rents')->where('status', 'Available')->get();
        $clients = DB::table('renter_details')->get();
        $staff = DB::table('staff')->whereIn('job_title', ['Manager', 'Supervisor'])->get();

        return view('leases.create', compact('properties', 'clients', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_no'     => 'required|exists:property_for_rents,property_no',
            'renter_no'       => 'required|exists:renter_details,renter_no',
            'staff_no'        => 'required|exists:staff,staff_no',
            'monthly_rent'    => 'required|numeric|min:0',
            'payment_method'  => 'required|string|max:50',
            'deposit_amount'  => 'required|numeric|min:0',
            'deposit_paid'    => 'required|boolean',
            'rent_start'      => 'required|date',
            // We validate the 3 to 12 month rule from the case study here:
            'duration_months' => 'required|integer|min:3|max:12', 
        ]);

        // Calculate Rent Finish Date to store in your 'rent_finish' column
        $rent_finish = Carbon::parse($request->rent_start)->addMonths($request->duration_months)->toDateString();

        // Generate Lease ID
        $last = DB::table('lease_agreements')->orderBy('lease_no', 'desc')->first();
        $num = $last ? ((int) preg_replace('/\D/', '', $last->lease_no)) + 1 : 1;
        $lease_no = 'LS' . str_pad($num, 3, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($request, $lease_no, $rent_finish) {
            // 1. Create the lease in your specific table
            DB::table('lease_agreements')->insert([
                'lease_no'       => $lease_no,
                'property_no'    => $request->property_no,
                'renter_no'      => $request->renter_no,
                'staff_no'       => $request->staff_no,
                'monthly_rent'   => $request->monthly_rent,
                'payment_method' => $request->payment_method,
                'deposit_amount' => $request->deposit_amount,
                'deposit_paid'   => $request->deposit_paid,
                'rent_start'     => $request->rent_start,
                'rent_finish'    => $rent_finish,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            
            // 2. Change property status to Rented
            DB::table('property_for_rents')
                ->where('property_no', $request->property_no)
                ->update(['status' => 'Rented']);
        });

        return redirect()->route('leases.index')->with('success', 'Lease Agreement created successfully.');
    }

    public function show(string $id)
    {
        $lease = DB::table('lease_agreements')->where('lease_no', $id)->first();
        abort_if(!$lease, 404);

        $property = DB::table('property_for_rents')->where('property_no', $lease->property_no)->first();
        $client = DB::table('renter_details')->where('renter_no', $lease->renter_no)->first();

        return view('leases.show', compact('lease', 'property', 'client'));
    }

    public function edit(string $id)
    {
        $lease = DB::table('lease_agreements')->where('lease_no', $id)->first();
        abort_if(!$lease, 404);

        $property = DB::table('property_for_rents')->where('property_no', $lease->property_no)->first();
        $client = DB::table('renter_details')->where('renter_no', $lease->renter_no)->first();

        return view('leases.edit', compact('lease', 'property', 'client'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'payment_method'  => 'required|string|max:50',
            'deposit_paid'    => 'required|boolean',
        ]);

        DB::table('lease_agreements')->where('lease_no', $id)->update([
            'payment_method' => $request->payment_method,
            'deposit_paid'   => $request->deposit_paid,
            'updated_at'     => now(),
        ]);

        return redirect()->route('leases.index')->with('success', 'Lease Agreement updated successfully.');
    }

    public function destroy(string $id)
    {
        $lease = DB::table('lease_agreements')->where('lease_no', $id)->first();

        DB::transaction(function () use ($id, $lease) {
            DB::table('lease_agreements')->where('lease_no', $id)->delete();
            
            // Revert property status to available
            DB::table('property_for_rents')
                ->where('property_no', $lease->property_no)
                ->update(['status' => 'Available']);
        });

        return redirect()->route('leases.index')->with('success', 'Lease terminated. Property is available again.');
    }
}