<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::get('/rent', [RentController::class, 'index']);


Route::get('/rent', function () {
    return view('layouts.rent');
});



// GET route - shows the form
Route::get('/rent', [RentController::class, 'create']);

// POST route - stores the data (THIS IS WHAT YOU WANT)
Route::post('/rent', [RentController::class, 'store'])->name('rent.store');
