<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('properties', PropertyController::class);
Route::resource('tenants', TenantController::class);
Route::resource('payments', PaymentController::class);

Route::get('/form', [FormController::class, 'create']);
Route::post('/form', [FormController::class, 'store'])->name('form.store');