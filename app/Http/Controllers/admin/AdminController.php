<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 

use App\Models\CustomersModel; 
use App\Models\AppPackagesModel; 
use App\Models\AppLevelPackagesModel; 
use App\Models\UsersModel;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admins.login');
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email', // Added email validation rule
            'password' => 'required',
        ]);

        // --- FIX: Use the specific superadmin guard for the attempt ---
        if (!Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ])) { // , $request->boolean('remember') Add optional 'remember me' support

            return back()->with('error', 'Invalid credentials.');
        }

        // Session regeneration for security after a fresh login via attempt
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // --- Dashboard ---
    public function dashboard()
    {
        return view('admins.dashboard');
    }

    // --- Specific Action: Login As Customer ---

    public function loginAsCustomer(Request $request, $customerId)
    {
        // 1. Get the currently authenticated admin user object
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            // This should ideally be caught by middleware, but good for safety
            return back()->withErrors(['error' => 'You must be logged in as an admin.']);
        }

        // 2. Find the target customer account
        $customer = CustomersModel::find($customerId);

        if (!$customer) {
            return back()->withErrors(['error' => 'Customer not found.']);
        }

        // 3. Store the original admin ID in the session (DO THIS FIRST OR SAFELY AFTER LOGIN)
        // We will use the Session facade for clarity.
        Session::put('original_admin_id', $admin->id);

        // 4. Log the admin out of the admin guard
        Auth::guard('admin')->logout();
        
        // 5. Log the admin in as the customer using the customer guard
        // This action establishes the new session context for the 'customer' guard.
        Auth::guard('customer')->login($customer); 
        
        // 6. Regenerate session ID for security best practice (session fixation prevention)
        $request->session()->regenerate();

        // 7. Redirect to the customer dashboard
        return redirect()->route('customer.dashboard');
    }

    public function returnToAdmin(Request $request)
    {
        // Check if we are currently "impersonating"
        if (Session::has('original_admin_id')) {
            $adminId = Session::pull('original_admin_id'); // Get the ID and remove it from session
            
            // Log out the current customer session
            Auth::guard('customer')->logout();
            
            // Log the original admin back in using the admin guard
            Auth::guard('admin')->loginUsingId($adminId);
            
            // Regenerate session ID
            $request->session()->regenerate();

            // Redirect back to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If no original admin ID found, just go home
        return redirect('/'); 
    }
}
