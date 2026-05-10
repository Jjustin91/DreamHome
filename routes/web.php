<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Existing Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Module 4: Rental & Viewing Management ---
    
    // Leases Route
    Route::get('/leases', function () {
        return view('leases.index');
    })->name('leases.index');

    // Property Viewings Route
    Route::get('/viewings', function () {
        return view('viewings.index');
    })->name('viewings.index');

    // Property Inspections Route
    Route::get('/inspections', function () {
        return view('inspections.index');
    })->name('inspections.index');
});

require __DIR__.'/auth.php';