<?php

namespace App\Http\Controllers;

use App\Models\RenterDetails as Client;
use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /** Client Records list */
    public function index(Request $request)
    {
        $allowed = ['renter_no', 'first_name', 'branch_no', 'staff_no', 'pref_property', 'max_rent'];
        $sortBy  = in_array($request->sort_by, $allowed) ? $request->sort_by : 'renter_no';
        $sortDir = $request->sort_dir === 'desc' ? 'desc' : 'asc';

        $clients = Client::query()
            ->when($request->search, fn($q, $s) =>
                $q->where('first_name', 'like', "%$s%")
                ->orWhere('last_name',  'like', "%$s%")
                ->orWhere('renter_no',  'like', "%$s%")
            )
            ->orderBy($sortBy, $sortDir)
            ->paginate(15)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    /** Client Details / Branch / Staff tabs */
    public function show(Client $client)
    {
        $branch = Branch::orderBy('branch_no')->get();

        $staffList = Staff::where('branch_no', $client->branch_no)
                          ->where('job_title', 'Salesperson')
                          ->withCount('renters')
                          ->get();

        $branchProperties = \App\Models\PropertyForRent::where('branch_no', $client->branch_no)
                                ->selectRaw('type_of_property as type, count(*) as count')
                                ->groupBy('type_of_property')
                                ->get()
                                ->map(fn($p) => ['type' => $p->type, 'count' => $p->count]);

        return view('clients.show', compact('client', 'branch', 'staffList', 'branchProperties'));
    }

    public function create()
    {
        $branch    = Branch::all();
        $staffList = collect(); // empty — will be loaded via AJAX based on branch

        return view('clients.create', compact('branch', 'staffList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'renter_no'     => 'required|string|max:10|unique:renter_details,renter_no',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'telephone_no'  => 'required|string|max:50',
            'pref_property' => 'required|in:Flat,House,Studio,Bungalow',
            'max_rent'      => 'required|numeric|min:0',
            'date'          => 'required|date',
            'branch_no'     => 'required|exists:branch,branch_no',
            'staff_no'      => 'required|exists:staff,staff_no',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'comments'      => 'nullable|string',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('clients', 'public');
        }

        Client::create($data);

        return redirect()->route('clients.index')
                         ->with('success', 'Client record created successfully.');
    }

    public function getStaffByBranch(Request $request)
    {
        $staff = Staff::where('job_title', 'Salesperson')
                      ->where('branch_no', $request->branch_no)
                      ->withCount('renters')
                      ->get(['staff_no', 'first_name', 'last_name', 'sex', 'job_title']);

        return response()->json($staff);
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:50',
            'last_name'     => 'required|string|max:50',
            'address'       => 'required|string|max:250',
            'telephone_no'  => 'required|string|max:20',
            'pref_property' => 'nullable|string|max:50',
            'max_rent'      => 'nullable|numeric',
            'date'          => 'nullable|date',
            'comments'      => 'nullable|string',
        ]);

        $client->update($data);

        return redirect()->route('clients.show', $client)->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted.');
    }

    /** PATCH: save branch assignment (Tab 2) */
    public function assignBranch(Request $request, Client $client)
    {
        $request->validate([
            'branch_no' => 'required|exists:branch,branch_no',
        ]);

        $client->update([
            'branch_no' => $request->branch_no,
            'staff_no'  => null, // reset staff when branch changes
        ]);

        return redirect()->route('clients.show', $client)
            ->with('success', 'Branch assigned.')
            ->withFragment('branch');
    }

    /** PATCH: save staff assignment (Tab 3) */
    public function assignStaff(Request $request, Client $client)
    {
        $request->validate([
            'staff_no' => 'required|exists:staff,staff_no',
        ]);

        $client->update([
            'staff_no' => $request->staff_no,
        ]);

        return redirect()->route('clients.show', $client)
            ->with('success', 'Staff assigned.')
            ->withFragment('staff');
    }
}