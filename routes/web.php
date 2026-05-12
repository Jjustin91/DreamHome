<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');

});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Client Records
    Route::resource('clients', ClientController::class)
        ->parameters(['clients' => 'client']);

    // Branch Assignment (Tab 2)
    Route::patch('/clients/{client}/assign-branch', [ClientController::class, 'assignBranch'])
        ->name('clients.assign-branch');

    // Staff Assignment (Tab 3)
    Route::get('/staff-by-branch', [ClientController::class, 'getStaffByBranch'])->name('staff.by.branch');
    Route::patch('/clients/{client}/assign-staff', [ClientController::class, 'assignStaff'])
        ->name('clients.assign-staff');

});

require __DIR__. '/auth.php';  