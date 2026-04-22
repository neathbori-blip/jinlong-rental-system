<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});



// The GET route to show the form
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// The POST route to process the data
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Example Dashboard (Protected)
Route::get('/dashboard', function () {
    return "Welcome to the system!";
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('properties', PropertyController::class);
Route::resource('tenants', TenantController::class);
Route::resource('payments', PaymentController::class);

Route::get('/form', [FormController::class, 'create']);
Route::post('/form', [FormController::class, 'store'])->name('form.store');



Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');