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
use App\Models\CustomerDepositsModel; 
use App\Models\CustomerWithdrawsModel;
use App\Models\NinepayTransactionsModel;

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
            dd('Invalid credentials.');
            return back()->with('error', 'Invalid credentials.');
            // return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid credentials.']);
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
        $admin = Auth::guard('admin')->user();

        // 1. Total Customers
        $data['total_customers'] = CustomersModel::where('app_id', $admin->app_id)->count();

        // 2. Total Activated Customers
        $data['total_activated_customers'] = CustomersModel::where('app_id', $admin->app_id)->where('status', 1)->count();

        // 3. Total Activated Packages
        $data['total_activated_packages'] = CustomerDepositsModel::where('app_id', $admin->app_id)->where('payment_status', 1)->count();

        // 4. Total Activated Amount (Paid)
        $data['total_activated_amount'] = CustomerDepositsModel::where('app_id', $admin->app_id)
                                                                    ->where('payment_status', 1)
                                                                    ->where('is_free_deposit', 0)
                                                                    ->sum('amount');

        // 5. Total Activated Amount (Free Package)
        $data['total_activated_amount_free'] = CustomerDepositsModel::where('app_id', $admin->app_id)
                                                                        ->where('payment_status', 1)
                                                                        ->where('is_free_deposit', 1)
                                                                        ->sum('amount');

        // 6. Total Withdraws
        $data['total_withdraws'] = CustomerWithdrawsModel::where('app_id', $admin->app_id)
                                                            ->where('transaction_status', 'success')
                                                            ->sum('amount');

        // 7. Total USDT (Wallet balance or deposits)
        $data['total_usdt'] = NinepayTransactionsModel::where('app_id', $admin->app_id)
                                                            ->where('currency', 'USDT')
                                                            ->where('network_type', 'credit')
                                                            ->where('payment_status', 'success')
                                                            ->sum('amount');
            
        return view('admins.dashboard', compact('data'));
    }

    // --- Specific Action: Login As Customer ---

    /*public function loginAsCustomer(Request $request, $customerId)
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
    }*/

    public function loginAsCustomer(Request $request, $customerId)
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) return back()->withErrors(['error' => 'You must be logged in as an admin.']);

        $customer = CustomersModel::find($customerId);
        if (!$customer) return back()->withErrors(['error' => 'Customer not found.']);
        
        // push current identity into stack
        $stack = Session::get('impersonation_stack', []);
        $last = end($stack);
        if (!$last || $last['guard'] !== 'admin' || $last['id'] !== $admin->id) {
            $stack[] = ['guard' => 'admin', 'id' => $admin->id];
            session(['impersonation_stack' => $stack]);
        }
        
        // $stack = Session::get('impersonation_stack', []);
        // $stack[] = ['guard' => 'admin', 'id' => $admin->id];
        // Session::put('impersonation_stack', $stack);

        Auth::guard('admin')->logout();
        Auth::guard('customer')->login($customer);

        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Logged in as customer.');
    }

    public function returnToAdmin(Request $request)
    {
        $stack = session('impersonation_stack', []);
        // dd(config('auth.guards.admin'), config('auth.providers'));
        // dd([
        //   'admin_check' => Auth::guard('admin')->check(),
        //   'admin_id' => Auth::guard('admin')->id(),
        //   'customer_check' => Auth::guard('customer')->check(),
        //   'stack' => session('impersonation_stack', []),
        //   'admin_dashboard_url' => route('admin.dashboard'),
        // ]);

        // $stack = session('impersonation_stack', []);
        if (empty($stack)) {
            return redirect()->route('login')->withErrors(['error' => 'No impersonation session found.']);
        }

        // must be customer now
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('login')->withErrors(['error' => 'You are not logged in as customer.']);
        }

        $prev = end($stack);
        if (!$prev || $prev['guard'] !== 'admin') {
            return redirect()->route('customer.dashboard')->withErrors(['error' => 'Return path to admin not found.']);
        }

        // 1) logout customer HARD
        Auth::guard('customer')->logout();
        $request->session()->forget(Auth::guard('customer')->getName());          // login_customer_xxx
        $request->session()->forget(Auth::guard('customer')->getRecallerName());  // remember_customer_xxx

        // 2) pop admin from stack
        $adminEntry = array_pop($stack);
        session(['impersonation_stack' => $stack]);

        // 3) login admin HARD
        $admin = UsersModel::findOrFail($adminEntry['id']);

        Auth::guard('admin')->login($admin);

        // Force session to contain admin id
        $request->session()->put(Auth::guard('admin')->getName(), $admin->getAuthIdentifier());

        // clear intended
        $request->session()->forget('url.intended');

        // rotate session id
        $request->session()->migrate(true);

        // DEBUG (remove after)
        // dd([
        //   'admin_guard_key' => Auth::guard('admin')->getName(),
        //   'admin_session_value' => session(Auth::guard('admin')->getName()),
        //   'admin_check' => Auth::guard('admin')->check(),
        //   'customer_check' => Auth::guard('customer')->check(),
        // ]);

        return redirect()->route('admin.dashboard')->with('success', 'Returned to admin.');
    }
}
