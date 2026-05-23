<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('property_adverts AS a')
            ->join('property_for_rents AS p', 'a.property_no', '=', 'p.property_no')
            ->select('a.*', 'p.street', 'p.city');

        // Satisfies Case Study (n) and (o): Filtering by Property or Newspaper
        if ($p = $request->property_no) {
            $query->where('a.property_no', $p);
        }
        if ($n = $request->newspaper_name) {
            $query->where('a.newspaper_name', $n);
        }

        $adverts = $query->orderBy('a.date_advertised', 'desc')->paginate(15)->withQueryString();
        
        $properties = DB::table('property_for_rents')->get();
        $newspapers = DB::table('newspapers')->get();

        return view('adverts.index', compact('adverts', 'properties', 'newspapers'));
    }

    public function create()
    {
        $properties = DB::table('property_for_rents')->where('status', 'Available')->get();
        $newspapers = DB::table('newspapers')->get();
        return view('adverts.create', compact('properties', 'newspapers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_no'     => 'required|exists:property_for_rents,property_no',
            'newspaper_name'  => 'required|exists:newspapers,newspaper_name',
            'date_advertised' => 'required|date',
            'cost'            => 'required|numeric|min:0',
        ]);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('property_adverts')->insert($data);
        return redirect()->route('adverts.index')->with('success', 'Advert logged successfully.');
    }

    public function destroy(string $id)
    {
        // Decode the composite key (PropertyNo___Newspaper___Date)
        [$property_no, $newspaper, $date] = explode('___', $id);

        DB::table('property_adverts')
            ->where('property_no', $property_no)
            ->where('newspaper_name', $newspaper)
            ->where('date_advertised', $date)
            ->delete();

        return redirect()->route('adverts.index')->with('success', 'Advert record deleted.');
    }
}