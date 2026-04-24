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

Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
Route::get('/tenants/{id}', [TenantController::class, 'show'])->name('tenants.show');
Route::put('/tenants/{id}', [TenantController::class, 'update'])->name('tenants.update');
Route::delete('/tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
Route::get('/', function () {
    return redirect()->route('tenants.index');
});