<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login'); 
    }

    public function login(Request $request) {
        // 1. Validation Logic
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        // 2. Security Logic: Attempt to log the user in
        // The second argument 'remember' handles the cookie logic automatically
        if (Auth::attempt($credentials, $request->remember)) {
            
            // 3. UX Logic: Prevent "Session Fixation" attacks
            $request->session()->regenerate();

            // Redirect to dashboard, or where they were trying to go
            return redirect()->intended('/dashboard');
        }

        // 4. Error Handling Logic: If it fails, send them back with a professional error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); 
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}