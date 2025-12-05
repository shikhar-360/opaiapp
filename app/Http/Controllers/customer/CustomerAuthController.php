<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function showRegisterForm($sponsorcode)
    {
        return view('customer.register', compact('sponsorcode'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:customers,email',
            'password'      => 'required|string|min:3|max:20',
            'sponsor_code' => 'required|string|exists:customers,referral_code',
        ]);

        // Get sponsor
        $sponsor = CustomersModel::where('referral_code', $validated['sponsor_code'])->firstOrFail();
        
        // Auto find app ID from sponsor
        $appId = $sponsor->app_id;

        $newCustomer = CustomersModel::create([
                            'app_id'        => $appId,
                            'name'          => $validated['name'],
                            'email'         => $validated['email'],
                            'password'      => Hash::make($validated['password']),
                            // 'referral_code' => strtoupper(Str::random(6)),
                            'sponsor_id'    => $sponsor->id,
                            'role'          => 'customer'
                        ]);
        
        $sponsor->direct_ids = trim(($sponsor->direct_ids ?? '') . '/' . $newCustomer->id, '/');
        $sponsor->save();

        $this->showLoginForm();
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $customer = CustomersModel::where('email', $validated['email'])->first();
        
        // --- DEBUGGING --- 
        // dd([
        //     'input_email' => $validated['email'],
        //     'customer_found' => (bool)$customer,
        //     'db_password_hash' => $customer ? $customer->password : 'N/A',
        //     'password_check_result' => $customer ? Hash::check($validated['password'], $customer->password) : false,
        // ]);
        // If 'password_check_result' is false, then the passwords do not match.
        // -----------------

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Auth::guard('customer')->login($customer); 

        $request->session()->regenerate();

        // return redirect()->route('customer.dashboard');

        return redirect()->route('customer.web3login');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }

    public function web3Login(Request $request)
    {
        $customer = Auth::guard('customer')->user();
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
