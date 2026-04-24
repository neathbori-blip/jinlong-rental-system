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

Route::get('/', function () {
    return redirect()->route('tenants.index');
});

Route::prefix('tenants')->name('tenants.')->group(function () {
    Route::get('/', [TenantController::class, 'index'])->name('index');
    Route::post('/', [TenantController::class, 'store'])->name('store');
    Route::get('/{id}', [TenantController::class, 'show'])->name('show');
    Route::put('/{id}', [TenantController::class, 'update'])->name('update');
    Route::delete('/{id}', [TenantController::class, 'destroy'])->name('destroy');
});