<?php

use App\Http\Controllers\SuperAdmin\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyViewingController;
use App\Http\Controllers\PropertyInspectionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\NewspaperController;
use App\Http\Controllers\AdvertController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Staff;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Fetch the HR record to link the logged-in user to their specific branch/staff data
    $staffProfile = \App\Models\Staff::where('staff_no', $user->staff_no)->first();
    
    $data = ['user' => $user, 'profile' => $staffProfile];

    if ($user->hasRole('Super Admin')) {
        $data['stats'] = [
            'branches' => \Illuminate\Support\Facades\DB::table('branches')->count(),
            'staff' => \Illuminate\Support\Facades\DB::table('staff')->count(),
            'properties' => \Illuminate\Support\Facades\DB::table('property_for_rents')->count(),
            'leases' => \Illuminate\Support\Facades\DB::table('lease_agreements')->count(),
        ];
    } 
    elseif ($user->hasRole('Manager') && $staffProfile) {
        $branchNo = $staffProfile->branch_no;
        $data['stats'] = [
            'branch_no' => $branchNo,
            'staff' => \Illuminate\Support\Facades\DB::table('staff')->where('branch_no', $branchNo)->count(),
            'available_props' => \Illuminate\Support\Facades\DB::table('property_for_rents')->where('branch_no', $branchNo)->where('status', 'Available')->count(),
            'rented_props' => \Illuminate\Support\Facades\DB::table('property_for_rents')->where('branch_no', $branchNo)->where('status', 'Rented')->count(),
        ];
    } 
    elseif ($user->hasRole('Supervisor')) {
        $data['stats'] = [
            'adverts' => \Illuminate\Support\Facades\DB::table('property_adverts')->count(),
            'inspections' => \Illuminate\Support\Facades\DB::table('property_inspections')->count(),
            'viewings' => \Illuminate\Support\Facades\DB::table('property_viewings')->count(),
        ];
    } 
    else {
        // Standard Staff / Salesperson Dashboard
        if ($staffProfile) {
            $data['my_viewings'] = \Illuminate\Support\Facades\DB::table('property_viewings')
                ->join('property_for_rents', 'property_viewings.property_no', '=', 'property_for_rents.property_no')
                ->where('property_viewings.staff_no', $staffProfile->staff_no)
                ->where('viewing_date', '>=', now()->toDateString())
                ->orderBy('viewing_date', 'asc')
                ->get();
        }
    }

    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');


// -------------------------------------------------------------
// SYSTEM BOOTSTRAP ROUTES (Super Admin Only)
// -------------------------------------------------------------
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    // Branch Routes
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy'); // <-- ADDED
    
    // Manager Routes
    Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
    Route::get('/managers/create', [ManagerController::class, 'create'])->name('managers.create');
    Route::post('/managers', [ManagerController::class, 'store'])->name('managers.store');
    Route::get('/managers/{manager}/edit', [ManagerController::class, 'edit'])->name('managers.edit');
    Route::put('/managers/{manager}', [ManagerController::class, 'update'])->name('managers.update');
    Route::delete('/managers/{manager}', [ManagerController::class, 'destroy'])->name('managers.destroy'); // <-- ADDED
});


// -------------------------------------------------------------
// MODULE 3: HR & ADMINISTRATIVE ROUTES (Super Admin & Manager)
// -------------------------------------------------------------
// Here is your new Staff Management route!
Route::middleware(['auth', 'role:Super Admin|Manager'])->group(function () {
    Route::resource('staff', StaffController::class);
    Route::resource('newspapers', NewspaperController::class)->except(['show', 'edit', 'update']);
});


// -------------------------------------------------------------
// MODULES 1, 2 & 4: OPERATIONS ROUTES (Shared by Admins, Managers & Supervisors)
// -------------------------------------------------------------
Route::middleware(['auth', 'role:Super Admin|Manager|Supervisor'])->group(function () {
    // Module 1: Properties & Owners
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::resource('properties', PropertyController::class)->except(['create']);
    Route::resource('owners', OwnerController::class);
    
    // Module 2: Client / Prospective Renter Management
    Route::resource('clients', ClientController::class);

    // Module 4: Lease Management
    Route::resource('leases', LeaseController::class);
});
// -------------------------------------------------------------
// ALL STAFF OPERATIONS (Viewings & Inspections)
// -------------------------------------------------------------
// Accessible by anyone who is logged into the system
Route::middleware('auth')->group(function () {
    Route::resource('viewings', PropertyViewingController::class);
    Route::resource('inspections', PropertyInspectionController::class)->except(['edit', 'update']);
    Route::resource('adverts', AdvertController::class)->except(['show', 'edit', 'update']);
});

// -------------------------------------------------------------
// DEFAULT BREEZE PROFILE ROUTES
// -------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';