<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('property_for_rents AS p')
            ->join('owners AS o', 'p.owner_no', '=', 'o.owner_no')
            ->join('branches AS b', 'p.branch_no', '=', 'b.branch_no')
            ->select(
                'p.*',
                'o.name AS owner_name',
                'o.telephone_no AS owner_telephone',
                'b.city AS branch_city'
            );

        if ($s = $request->search) {
            $query->where(function ($q) use ($s) {
                $q->where('p.property_no', 'ilike', "%$s%")
                  ->orWhere('p.city',        'ilike', "%$s%")
                  ->orWhere('p.street',      'ilike', "%$s%")
                  ->orWhere('p.type_of_property', 'ilike', "%$s%")
                  ->orWhere('o.name',        'ilike', "%$s%");
            });
        }
        if ($request->status) {
            $query->where('p.status', $request->status);
        }
        if ($request->type) {
            $query->where('p.type_of_property', $request->type);
        }

        $properties = $query->orderBy('p.property_no')->paginate(9)->withQueryString();

        $stats = [
            'total'     => DB::table('property_for_rents')->count(),
            'available' => DB::table('property_for_rents')->where('status', 'Available')->count(),
            'rented'    => DB::table('property_for_rents')->where('status', 'Rented')->count(),
            'owners'    => DB::table('owners')->count(),
        ];

        return view('properties.index', compact('properties', 'stats'));
    }

    public function create()
    {   
        // Ensure role check matches your Dev system
        if (!auth()->user()->hasAnyRole(['Super Admin', 'Manager', 'Supervisor'])) {
            return redirect()->route('properties.index')->with('error', 'Unauthorized.');
        }

        // Fetch necessary data for dropdowns
        $owners = DB::table('owners')->orderBy('name')->get();
        $branches = DB::table('branches')->orderBy('branch_no')->get();
        
        // Fetch only active staff
        $staff = DB::table('staff')
            ->whereNull('end_date')
            ->orderBy('last_name')
            ->get();

        return view('properties.create', compact('owners', 'branches', 'staff'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'street'           => 'required|string|max:100',
            'area'             => 'nullable|string|max:50',
            'city'             => 'required|string|max:50',
            'postcode'         => 'nullable|string|max:10',
            'type_of_property' => 'required|string|max:20',
            'number_of_rooms'  => 'required|integer|min:1',
            'monthly_rent'     => 'required|numeric|min:0',
            'status'           => 'required|string|in:Available,Rented,Reserved',
            'owner_no'         => 'required|string|exists:owners,owner_no',
            'branch_no'        => 'required|string|exists:branches,branch_no',
            'staff_no'         => 'required|string|exists:staff,staff_no',
            'property_image'   => 'nullable|image|max:4096',
        ]);

        unset($data['property_image']);

        if ($request->hasFile('property_image')) {
            $data['image_path'] = $request->file('property_image')->store('properties', 'public');
        }

        $last = DB::table('property_for_rents')
            ->orderByRaw("CAST(SUBSTRING(property_no FROM '[0-9]+') AS INTEGER) DESC")
            ->value('property_no');
        $num = $last ? ((int) preg_replace('/\D/', '', $last)) + 1 : 1;
        $data['property_no'] = 'PR' . str_pad($num, 3, '0', STR_PAD_LEFT);

        if (empty($data['postcode'])) {
            $data['postcode'] = DB::table('branches')->where('branch_no', $data['branch_no'])->value('postcode') ?? '';
        }

        DB::table('property_for_rents')->insert($data);

        return redirect()->route('properties.index')->with('success', 'Property '.$data['property_no'].' added successfully.');
    }

    public function show(string $id)
    {
        $property = DB::table('property_for_rents AS p')
            ->join('owners AS o',  'p.owner_no',  '=', 'o.owner_no')
            ->join('branches AS b', 'p.branch_no', '=', 'b.branch_no')
            ->select(
                'p.*',
                'o.name AS owner_name', 'o.address AS owner_address',
                'o.image_path AS owner_photo',
                'o.telephone_no AS owner_telephone',
                'b.street AS branch_street', 'b.area AS branch_area',
                'b.city AS branch_city', 'b.postcode AS branch_postcode',
                'b.fax_no AS branch_fax'
            )
            ->where('p.property_no', $id)
            ->first();

        abort_if(!$property, 404);

        $allNos = DB::table('property_for_rents')->orderBy('property_no')->pluck('property_no')->toArray();
        $idx    = array_search($id, $allNos);
        $prevNo = $idx > 0 ? $allNos[$idx - 1] : null;
        $nextNo = isset($allNos[$idx + 1]) ? $allNos[$idx + 1] : null;

        return view('properties.show', compact('property', 'prevNo', 'nextNo'));
    }

    public function edit(string $id)
    {
        $property = DB::table('property_for_rents AS p')
            ->join('owners AS o',  'p.owner_no',  '=', 'o.owner_no')
            ->join('branches AS b', 'p.branch_no', '=', 'b.branch_no')
            ->select(
                'p.*',
                'o.name AS owner_name', 'o.address AS owner_address',
                'o.telephone_no AS owner_telephone',
                'o.image_path AS owner_photo',
                'b.street AS branch_street', 'b.area AS branch_area',
                'b.city AS branch_city', 'b.postcode AS branch_postcode',
                'b.fax_no AS branch_fax'
            )
            ->where('p.property_no', $id)
            ->first();

        abort_if(!$property, 404);

        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'street'           => 'required|string|max:100',
            'area'             => 'nullable|string|max:50',
            'city'             => 'required|string|max:50',
            'type_of_property' => 'required|string|max:20',
            'number_of_rooms'  => 'required|integer|min:1',
            'monthly_rent'     => 'required|numeric|min:0',
            'status'           => 'required|string|in:Available,Rented,Reserved',
        ]);

        $property = DB::table('property_for_rents')->where('property_no', $id)->first();
        $imagePath = $property->image_path;

        if ($request->hasFile('property_image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('property_image')->store('properties', 'public');
        }

        DB::table('property_for_rents')->where('property_no', $id)->update([
            'street'           => $validated['street'],
            'area'             => $validated['area'] ?? '',
            'city'             => $validated['city'],
            'type_of_property' => $validated['type_of_property'],
            'number_of_rooms'  => $validated['number_of_rooms'],
            'monthly_rent'     => $validated['monthly_rent'],
            'status'           => $validated['status'],
            'image_path'       => $imagePath,
        ]);

        return redirect()->route('properties.index')->with('success', 'Property '.$id.' updated successfully.');
    }

    public function destroy(string $id)
    {
        $img = DB::table('property_for_rents')->where('property_no', $id)->value('image_path');
        if ($img) Storage::disk('public')->delete($img);

        DB::table('property_for_rents')->where('property_no', $id)->delete();

        return redirect()->route('properties.index')->with('success', 'Property '.$id.' deleted.');
    }
}