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
    
   
    public function authenticate(Request $request)
    {
    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;


        if ($email === 'admin@jinglong.com' && $password === 'password') {
        
            return redirect('/dashboard');
        }

      
        return back()->with('error', 'Invalid email or password!');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}