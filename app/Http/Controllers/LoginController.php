<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Show login page
    public function index()
    {
        return view('login.index');
    }
    

    public function logout()
    {
        
        return redirect('/login');
    }
}