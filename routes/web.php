<?php 
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
  
Route::get('/login', function () {
    return view('login');
});



Route::get('/rent', function () {
    return view('rent');
});

Route::get('/rent', [RentController::class, 'index']);