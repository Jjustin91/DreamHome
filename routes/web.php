<?php

use App\Http\Controllers\SuperAdmin\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController; // <-- 1. You must import your new controller
use Illuminate\Support\Facades\Route;
use App\Models\Branch;
use App\Models\Staff;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Gather live statistics for the Super Admin
    $stats = [
        'total_branches' => Branch::count(),
        'total_staff' => Staff::count(),
        'total_managers' => Staff::where('job_title', 'Manager')->count(),
    ];
    
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

// -------------------------------------------------------------
// SUPER ADMIN ONLY ROUTES
// -------------------------------------------------------------
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    // 1. Route to show the form
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    // 2. Route to accept the form submission and save to database
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    
    // Manager Routes
    Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
    Route::get('/managers/create', [ManagerController::class, 'create'])->name('managers.create');
    Route::post('/managers', [ManagerController::class, 'store'])->name('managers.store');
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