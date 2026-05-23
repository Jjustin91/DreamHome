<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        // UPDATED: 'owner' to 'owners'
        $query = DB::table('owners');

        // Search Logic
        if ($s = $request->search) {
            $query->where('name', 'ilike', "%$s%")
                ->orWhere('owner_no', 'ilike', "%$s%");
        }

        $owners = $query->orderBy('owner_no')->paginate(8);
        
        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate - Ensure 'image_path' matches the 'name' attribute in your HTML
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'telephone_no' => 'required|string',
            'image_path' => 'nullable|image|max:5120', // Bumped to 5MB for convenience
        ]);

        try {
            // 2. Prepare data for insert
            $data = [
                'name'         => $request->name,
                'address'      => $request->address,
                'telephone_no' => $request->telephone_no,
                'image_path'   => null, // Default to null
            ];

            // 3. Handle the image upload
            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('owners', 'public');
            }

            // 4. Generate ID (OW001, OW002, etc.)
            // UPDATED: 'owner' to 'owners'
            $last = DB::table('owners')->orderBy('owner_no', 'desc')->first();
            $num = $last ? ((int) preg_replace('/\D/', '', $last->owner_no)) + 1 : 1;
            $data['owner_no'] = 'OW' . str_pad($num, 3, '0', STR_PAD_LEFT);

            // 5. Insert into Database
            // UPDATED: 'owner' to 'owners'
            DB::table('owners')->insert($data);

            return redirect()->route('owners.index')
                ->with('success', 'Owner profile for ' . $request->name . ' has been created!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Failed to save owner: " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // UPDATED: 'owner' to 'owners'
        $owner = DB::table('owners')
            ->where('owner_no', $id)
            ->first();

        abort_if(!$owner, 404);

        // UPDATED: 'property_for_rent' to 'property_for_rents'
        $properties = DB::table('property_for_rents')
            ->where('owner_no', $id)
            ->get();

        return view('owners.show', compact('owner', 'properties'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // UPDATED: 'owner' to 'owners'
        $owner = DB::table('owners')
            ->where('owner_no', $id)
            ->first();

        abort_if(!$owner, 404);

        return view('owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'telephone_no' => 'required|string',
            'image_path' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image_path')) {
            // 1. Get the old image path from DB
            // UPDATED: 'owner' to 'owners'
            $oldImage = DB::table('owners')->where('owner_no', $id)->value('image_path');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            $data['image_path'] = $request->file('image_path')->store('owners', 'public');
        }

        // UPDATED: 'owner' to 'owners'
        DB::table('owners')->where('owner_no', $id)->update($data);

        return redirect()->route('owners.index')->with('success', 'Owner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // UPDATED: 'owner' to 'owners'
        DB::table('owners')->where('owner_no', $id)->delete();

        return redirect()->route('owners.index')->with('success', 'Owner deleted successfully.');
    }
}