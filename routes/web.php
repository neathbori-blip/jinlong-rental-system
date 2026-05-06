
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\MaintenanceRequestController;

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show'); 
Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');



Route::resource('tenants', TenantController::class);


Route::resource('payments', PaymentController::class);



Route::resource('leases', LeaseController::class);



Route::resource('maintenance', MaintenanceRequestController::class);

Route::view('/reports', 'reports.index')->name('reports.index');


Route::view('/settings', 'settings.index')->name('settings.index');


Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/authenticate', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    return redirect()->route('logout');
});
