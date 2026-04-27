
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::view('/dashboard', 'dashboard')->name('dashboard');


Route::view('/properties', 'properties.index')->name('properties.index');


Route::view('/tenants', 'tenants.index')->name('tenants.index');


Route::view('/payments', 'payments.index')->name('payments.index');  


Route::view('/leases', 'leases.index')->name('leases.index');


Route::view('/maintenance', 'maintenance.index')->name('maintenance.index');


Route::view('/reports', 'reports.index')->name('reports.index');


Route::view('/settings', 'settings.index')->name('settings.index');


Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

// Home
Route::get('/', function () {
    return redirect()->route('dashboard');
});
