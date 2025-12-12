<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use App\Models\CustomersModel;

// use Elliptic\EC; 
// use kornrunner\Keccak;
use App\Services\WalletService;

class CustomerAuthController extends Controller
{
    protected $walletServices;

    public function __construct(WalletService $walletService)
    {
        $this->walletServices = $walletService;
    }

    public function showRegisterForm($sponsorcode = null)
    {
        if(empty($sponsorcode))
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid referral code']);
        }

        $sponsor = CustomersModel::where('referral_code', $sponsorcode)->first();
        
        if (!$sponsor) {
            return redirect()->route('login')->with('status', 'Invalid referral code');
        }


        // else{
        //  return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid referral code']);
        //     return redirect()->back()->with(['status'=>'success', 'Referral code verified successfully!']);
        // }

        return view('customer.register', compact('sponsorcode'));
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:customers,email',
            'phone'          => 'required|numeric|unique:customers,phone',
            'sponsor_code'   => 'required|string|exists:customers,referral_code',
            'password'       => 'required|string|min:3|max:20|confirmed',
            'wallet_address' => 'required|string|max:255',
        ]);

        // Get sponsor
        $sponsor = CustomersModel::where('referral_code', $validated['sponsor_code'])->firstOrFail();
        if(!$sponsor)
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid referral code']);
        }
        
        // Auto find app ID from sponsor
        $appId = $sponsor->app_id;

        $lastSixDigits = substr($validated['wallet_address'], -6);

        $newCustomer = CustomersModel::create([
                            'app_id'        => $appId,
                            'name'          => $validated['name'],
                            'wallet_address'=> $validated['wallet_address'],
                            'email'         => $validated['email'],
                            'phone'         => $validated['phone'],
                            'password'      => Hash::make($validated['password']),
                            'referral_code' => $lastSixDigits,
                            'sponsor_id'    => $sponsor->id,
                            'role'          => 'customer'
                        ]);
        
        $sponsor->direct_ids = trim(($sponsor->direct_ids ?? '') . '/' . $newCustomer->id, '/');
        $sponsor->save();

        // $this->showLoginForm();
        return redirect()->route('login')->with(['status_code'=>'success', 'message' => 'Registration Successful.']);
        
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        $customer = CustomersModel::where('email', $validated['email'])->first();
        // dd($customer);
        // --- DEBUGGING --- 
        // dd([
        //     'input_email' => $validated['email'],
        //     'customer_found' => (bool)$customer,
        //     'db_password_hash' => $customer ? $customer->password : 'N/A',
        //     'password_check_result' => $customer ? Hash::check($validated['password'], $customer->password) : false,
        // ]);
        // If 'password_check_result' is false, then the passwords do not match.
        // -----------------
        if (!$customer) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid credentials']);
        }
        else if (!$customer || !Hash::check($validated['password'], $customer->password)) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid credentials']);
        }

        Auth::guard('customer')->login($customer); 

        $request->session()->regenerate();

        return redirect()->route('dashboard');

        // return redirect()->route('customer.web3login');
    }

    public function logout(Request $request)
    {
        if (Session::has('original_admin_id')) {
            // --- Switch back to Admin account ---

            $adminId = Session::pull('original_admin_id'); // Get the ID and clear the session key

            // Log out the current customer guard
            Auth::guard('customer')->logout();

            // Log the original admin back in using the 'admin' guard
            Auth::guard('admin')->loginUsingId($adminId);

            // Regenerate session ID for security
            $request->session()->regenerate();

            // Redirect back to the admin dashboard
            return redirect()->route('admin.dashboard')->with('status', 'Returned to admin session.');
        }

        Auth::guard('customer')->logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function web3Login(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // if (!Auth::guard('customer')->check() || Auth::guard('customer')->user()->role !== 'customer') {
        //     // If the check fails, redirect them (which shouldn't happen right after login)
        //     return redirect()->route('customer.login'); 
        // }
        
        return view('customer.walletconnect', [
            'customer' => $customer
        ]);
    }

    public function generateNonce(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $nonce = $this->walletServices->generateNonce($customer);
        return response()->json(['nonce' => $nonce]);
    }

    public function verifyWalletOwnership(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $validated = $request->validate([
            'wallet_address' => 'required|regex:/^0x[a-fA-F0-9]{40}$/',
            'signature' => 'required|string',
        ]);

        try 
        {
            $isVerified = $this->walletServices->verifyOwnership($validated['wallet_address'], $validated['signature'], $customer);

            if ($isVerified) {
                return response()->json(['success' => true, 'message' => 'Wallet ownership verified!']);
            }

        } 
        catch (Exception $e) 
        {
            return response()->json([
                'success' => false, 
                'message' => 'Error during signature verification.',
                'error_details' => $e->getMessage() 
            ], 500);
        }
    }

}
