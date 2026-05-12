<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\admin\BranchController;


Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('staff', StaffController::class);
    Route::resource('branches', BranchController::class);
    
    Route::post('branches/{branch}/assign-staff', [BranchController::class, 'assignStaff'])
        ->name('branches.assign-staff'); 
});



// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Property Management 
Route::middleware('auth')->group(function () {
    
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::resource('properties', PropertyController::class)->except(['create']);
});

//Owner Management
Route::middleware('auth')->group(function () {
    Route::resource('owners', OwnerController::class);
});
//Auth::routes();

require __DIR__.'/auth.php';