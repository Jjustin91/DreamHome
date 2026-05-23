<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewspaperController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('newspapers');
        if ($s = $request->search) {
            $query->where('newspaper_name', 'ilike', "%$s%");
        }
        $newspapers = $query->orderBy('newspaper_name')->paginate(10);
        return view('newspapers.index', compact('newspapers'));
    }

    public function create()
    {
        return view('newspapers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'newspaper_name' => 'required|string|max:100|unique:newspapers,newspaper_name',
            'address'        => 'required|string|max:250',
            'telephone_no'   => 'required|string|max:20',
            'contact_name'   => 'required|string|max:100',
        ]);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('newspapers')->insert($data);
        return redirect()->route('newspapers.index')->with('success', 'Newspaper contact added.');
    }

    public function destroy(string $id)
    {
        DB::table('newspapers')->where('newspaper_name', $id)->delete();
        return redirect()->route('newspapers.index')->with('success', 'Newspaper removed.');
    }
}