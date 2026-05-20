<?php

use App\Http\Controllers\SuperAdmin\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Staff;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    // ---------------------------------------------------------
    // 1. SUPER ADMIN DASHBOARD LOGIC
    // ---------------------------------------------------------
    if ($user->hasRole('Super Admin')) {
        $stats = [
            'total_branches' => Branch::count(),
            'total_staff' => Staff::count(),
            'total_managers' => Staff::where('job_title', 'Manager')->count(),
        ];
        return view('dashboard', compact('stats'));
    }

    // ---------------------------------------------------------
    // 2. MANAGER DASHBOARD LOGIC
    // ---------------------------------------------------------
    if ($user->hasRole('Manager')) {
        // Find the Manager's HR record to see which branch they run
        $managerProfile = Staff::with('branch')->where('staff_no', $user->staff_no)->first();
        $branchNo = $managerProfile->branch_no;

        $stats = [
            'my_staff_count' => Staff::where('branch_no', $branchNo)->count(),
            // We will add total properties here later!
        ];
        
        return view('dashboard', compact('stats', 'managerProfile'));
    }

    // Default fallback for other roles
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// -------------------------------------------------------------
// SUPER ADMIN ONLY ROUTES
// -------------------------------------------------------------
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    
    // Branch Routes
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/{branch}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    
    // Manager Routes
    Route::get('/managers', [ManagerController::class, 'index'])->name('managers.index');
    Route::get('/managers/create', [ManagerController::class, 'create'])->name('managers.create');
    Route::post('/managers', [ManagerController::class, 'store'])->name('managers.store');
    Route::get('/managers/{manager}/edit', [ManagerController::class, 'edit'])->name('managers.edit');
    Route::put('/managers/{manager}', [ManagerController::class, 'update'])->name('managers.update');
    
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