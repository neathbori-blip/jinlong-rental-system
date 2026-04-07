<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

 
Route::get('/user', function () {
    // Get users from database
    $users = \App\Models\User::all();  // Or however you want to get users
    
    // Pass the variable to the view
    return view('users.index', ['users' => $users]);
    // Or using compact()
    // return view('users.index', compact('users'));
});

Route::get('/', function () {

return view('unit');

});


Route::get('/', function () {

return view('leas');

});


Route::get('/', function () {

return view('user');

});


Route::get('/', function () {

return view('user');

});


Route::get('/', function () {

return view('user');

});


Route::get('/', function () {

return view('user');

});






