<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
Route::resource('properties', PropertyController::class);
Route::resource('tenants', TenantController::class);
Route::resource('payments', PaymentController::class);








use App\Http\Controllers\ProfileController;
Route::get('/', function () {
    return view('welcome');
});

// Name your routes for easier reference
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

// ADD THIS LINE ↓↓↓
Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');


Route::get('/test-add-properties', function() {
    for($i = 1; $i <= 10; $i++) {
        App\Models\Property::create([
            'title' => "Test Property $i",
            'type' => 'Apartment',
            'price' => rand(100000, 500000),
            'location' => 'Test Location',
            'bedrooms' => rand(1, 4),
            'bathrooms' => rand(1, 3),
            'description' => 'This is test property number ' . $i,
        ]);
    }
    return "Added 10 test properties! Total: " . App\Models\Property::count();
});

Route::resource('properties', PropertyController::class);
// or
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');