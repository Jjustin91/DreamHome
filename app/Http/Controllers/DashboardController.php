<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Staff;
use App\Models\RenterDetails;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBranch  = Branch::count();
        $totalStaff     = Staff::whereNull('end_date')->count();
        $totalClients   = RenterDetails::count();

        $recentClients  = RenterDetails::with(['branch', 'staff'])
                            ->orderByDesc('date')
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalBranch',
            'totalStaff',
            'totalClients',
            'recentClients'
        ));
    }
}