<?php

use App\Http\Controllers\ProfileController; // <--- This was the missing piece!
use App\Http\Controllers\LeaseAgreementController;
use App\Http\Controllers\PropertyViewingController;
use App\Http\Controllers\PropertyInspectionController;
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
    Route::get('/leases', [LeaseAgreementController::class, 'index'])->name('leases.index');
    Route::post('/leases', [LeaseAgreementController::class, 'store'])->name('leases.store');

    // Property Viewings Route
    Route::get('/viewings', [PropertyViewingController::class, 'index'])->name('viewings.index');
    Route::post('/viewings', [PropertyViewingController::class, 'store'])->name('viewings.store');
    
    // Property Inspections Route
    Route::get('/inspections', [PropertyInspectionController::class, 'index'])->name('inspections.index');
    Route::post('/inspections', [PropertyInspectionController::class, 'store'])->name('inspections.store');
});

require __DIR__.'/auth.php';