<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('renter_details');

        // Handle Search
        if ($s = $request->search) {
            $query->where(function($q) use ($s) {
                $q->where('first_name', 'ilike', "%$s%")
                  ->orWhere('last_name', 'ilike', "%$s%")
                  ->orWhere('renter_no', 'ilike', "%$s%")
                  ->orWhere('branch_no', 'ilike', "%$s%");
            });
        }

        // Handle Filter
        if ($p = $request->pref_property) {
            $query->where('pref_property', $p);
        }

        $clients = $query->orderBy('renter_no')->paginate(10)->withQueryString();
        
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        // Spatie Role Check
        if (!auth()->user()->hasAnyRole(['Super Admin', 'Manager', 'Supervisor'])) {
            return redirect()->route('clients.index')->with('error', 'Unauthorized.');
        }

        // THIS FIXES THE ERROR: Fetch branches and active staff for the dropdowns
        $branches = DB::table('branches')->orderBy('branch_no')->get();
        $staff = DB::table('staff')->whereNull('end_date')->orderBy('last_name')->get();

        return view('clients.create', compact('branches', 'staff'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'telephone_no'  => 'required|string|max:20',
            'address'       => 'required|string|max:250',
            'pref_property' => 'nullable|string|max:50',
            'max_rent'      => 'nullable|numeric|min:0',
            'comments'      => 'nullable|string',
            'branch_no'     => 'required|string|exists:branches,branch_no',
            'staff_no'      => 'required|string|exists:staff,staff_no',
        ]);

        // Generate Client ID (e.g., CR001, CR002)
        $last = DB::table('renter_details')->orderBy('renter_no', 'desc')->first();
        $num = $last ? ((int) preg_replace('/\D/', '', $last->renter_no)) + 1 : 1;
        $data['renter_no'] = 'CR' . str_pad($num, 3, '0', STR_PAD_LEFT);
        
        // Stamp the registration date
        $data['date'] = now()->toDateString();

        DB::table('renter_details')->insert($data);

        return redirect()->route('clients.index')
            ->with('success', 'Client ' . $data['first_name'] . ' ' . $data['last_name'] . ' registered successfully.');
    }

    public function show(string $id)
    {
        $client = DB::table('renter_details')->where('renter_no', $id)->first();
        abort_if(!$client, 404);

        return view('clients.show', compact('client'));
    }

    public function edit(string $id)
    {
        $client = DB::table('renter_details')->where('renter_no', $id)->first();
        abort_if(!$client, 404);

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'telephone_no'  => 'required|string|max:20',
            'address'       => 'required|string|max:250',
            'pref_property' => 'nullable|string|max:50',
            'max_rent'      => 'nullable|numeric|min:0',
            'comments'      => 'nullable|string',
        ]);

        DB::table('renter_details')->where('renter_no', $id)->update($data);

        return redirect()->route('clients.index')->with('success', 'Client details updated successfully.');
    }

    public function destroy(string $id)
    {
        DB::table('renter_details')->where('renter_no', $id)->delete();

        return redirect()->route('clients.index')->with('success', 'Client record permanently deleted.');
    }
}