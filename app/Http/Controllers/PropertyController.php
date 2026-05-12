<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('property_for_rent AS p')
            ->join('owner AS o', 'p.owner_no', '=', 'o.owner_no')
            ->join('branch AS b', 'p.branch_no', '=', 'b.branch_no')
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
            'total'     => DB::table('property_for_rent')->count(),
            'available' => DB::table('property_for_rent')->where('status', 'Available')->count(),
            'rented'    => DB::table('property_for_rent')->where('status', 'Rented')->count(),
            'owners'    => DB::table('owner')->count(),
        ];

        return view('properties.index', compact('properties', 'stats'));
    }

    public function create()
    {   
        if (!in_array(auth()->user()->job_title, ['Admin', 'Manager', 'Supervisor'])) {
            return redirect()->route('properties.index')->with('error', 'Unauthorized.');
            }

            // 2. Fetch necessary data for dropdowns
            $owners = DB::table('owner')->orderBy('name')->get();
            $branches = DB::table('branch')->orderBy('branch_no')->get();
            
            // Fetch only active staff (where end_date is null)
            $staff = DB::table('staff')
                ->whereNull('end_date')
                ->orderBy('last_name')
                ->get();

            // 3. Return the view with the data
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
            'owner_no'         => 'required|string|exists:owner,owner_no',
            'branch_no'        => 'required|string|exists:branch,branch_no',
            'staff_no'         => 'required|string|exists:staff,staff_no',
            'property_image'   => 'nullable|image|max:4096',
        ]);

        unset($data['property_image']);

        // Handle Property Image upload
        if ($request->hasFile('property_image')) {
            $data['image_path'] = $request->file('property_image')->store('properties', 'public');
        }

        // Auto-generate property_no
        $last = DB::table('property_for_rent')
            ->orderByRaw("CAST(SUBSTRING(property_no FROM '[0-9]+') AS INTEGER) DESC")
            ->value('property_no');
        $num = $last ? ((int) preg_replace('/\D/', '', $last)) + 1 : 1;
        $data['property_no'] = 'PR' . str_pad($num, 3, '0', STR_PAD_LEFT);

        // Auto postcode from branch
        if (empty($data['postcode'])) {
            $data['postcode'] = DB::table('branch')->where('branch_no', $data['branch_no'])->value('postcode') ?? '';
        }


        DB::table('property_for_rent')->insert($data);

        return redirect()->route('properties.index')->with('success', 'Property '.$data['property_no'].' added successfully.');
    }

    public function show(string $id)
    {
        $property = DB::table('property_for_rent AS p')
            ->join('owner AS o',  'p.owner_no',  '=', 'o.owner_no')
            ->join('branch AS b', 'p.branch_no', '=', 'b.branch_no')
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

        // Previous / next navigation
        $allNos = DB::table('property_for_rent')->orderBy('property_no')->pluck('property_no')->toArray();
        $idx    = array_search($id, $allNos);
        $prevNo = $idx > 0 ? $allNos[$idx - 1] : null;
        $nextNo = isset($allNos[$idx + 1]) ? $allNos[$idx + 1] : null;

        return view('properties.show', compact('property', 'prevNo', 'nextNo'));
    }

    public function edit(string $id)
    {
        $property = DB::table('property_for_rent AS p')
            ->join('owner AS o',  'p.owner_no',  '=', 'o.owner_no')
            ->join('branch AS b', 'p.branch_no', '=', 'b.branch_no')
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

        // 2. Fetch the existing image path
        $property = DB::table('property_for_rent')->where('property_no', $id)->first();
        $imagePath = $property->image_path;

        // 3. Handle File Upload
        if ($request->hasFile('property_image')) {
            // Delete old image if it exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Store new image and update the path variable
            $imagePath = $request->file('property_image')->store('properties', 'public');
        }

        // 4. Update the database with EXPLICIT keys
        DB::table('property_for_rent')->where('property_no', $id)->update([
            'street'           => $validated['street'],
            'area'             => $validated['area'],
            'city'             => $validated['city'],
            'type_of_property' => $validated['type_of_property'],
            'number_of_rooms'  => $validated['number_of_rooms'],
            'monthly_rent'     => $validated['monthly_rent'],
            'status'           => $validated['status'],
            'image_path'       => $imagePath, // Use the correct column name
        ]);

        return redirect()->route('properties.index')->with('success', 'Property '.$id.' updated successfully.');
    }

    public function destroy(string $id)
    {
        $img = DB::table('property_for_rent')->where('property_no', $id)->value('image_path');
        if ($img) Storage::disk('public')->delete($img);

        DB::table('property_for_rent')->where('property_no', $id)->delete();

        return redirect()->route('properties.index')->with('success', 'Property '.$id.' deleted.');
    }
}