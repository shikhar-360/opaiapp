<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('superadmin.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout(); 

        // Invalidate the session to remove all session data
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page (or wherever you want them to go)
        return redirect()->route('superadmin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // Added email validation rule
            'password' => 'required',
        ]);

        // --- FIX: Use the specific superadmin guard for the attempt ---
        if (!Auth::guard('superadmin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'superadmin'
        ])) { // , $request->boolean('remember') Add optional 'remember me' support

            return back()->with('error', 'Invalid credentials or role.');
        }

        // Session regeneration for security after a fresh login via attempt
        $request->session()->regenerate();

        return redirect()->route('superadmin.dashboard');
    }
}
