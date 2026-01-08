<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\CustomersModel;
use App\Models\ForgotPasswordRequestsModel;
use App\Models\CustomerSettingsModel;

// use Elliptic\EC; 
// use kornrunner\Keccak;
use App\Services\WalletService;
use App\Services\Email\EmailService;

use App\Traits\ManagesCustomerFinancials;
use App\Traits\ManagesCustomerHierarchy;

class CustomerAuthController extends Controller
{
    protected $walletServices;
    protected $emailService;

    use ManagesCustomerFinancials;
    use ManagesCustomerHierarchy;

    public function __construct(WalletService $walletService, EmailService $emailService)
    {
        $this->walletServices = $walletService;
        $this->emailService = $emailService;
    }

    // public function showRegisterForm($sponsorcode = null)
    // {
    public function showRegisterForm(Request $request)
    {

        $customer = Auth::guard('customer')->user();
        if($customer){
            return redirect()->route('dashboard');
        }
        
        $sponsorcode = $request->query('sponsorcode');

        // if(empty($sponsorcode))
        // {
        //     return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid referral code']);
        // }

        if(empty($sponsorcode) || !$sponsorcode)
        {
            $sponsorcode = '';
            return view('customer.register', compact('sponsorcode'));
        }

        $sponsor = CustomersModel::where('referral_code', $sponsorcode)->first();
        
        
        if (!$sponsor) 
        {
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

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'phone'    => 'nullable|string|min:10|max:20|unique:customers,phone',
            'sponsor_code' => 'required|string|exists:customers,referral_code',
            'password' => 'required|string|min:3|max:20|confirmed',
            'telegram_username' => 'nullable|string|max:255|unique:customers,telegram_username',
        ]);

        if ($validator->fails()) 
        {
            if($validator->errors()->get('sponsor_code'))
            {
                return back()->withInput()->withErrors(['status_code'=>'error', 'message' => 'Please ask your mentor or referrer for Mentor ID']);  //$validator->errors()->get('sponsor_code')
            }
            else if($validator->errors()->get('name'))
            {
                return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('name')]);
            }
            else if($validator->errors()->get('email'))
            {
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('email')]); 
            }
            else if($validator->errors()->get('phone'))
            {
                return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('phone')]);
            }
            else if($validator->errors()->get('password'))
            {
                return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('password')]);
            }
            else if($validator->errors()->get('telegram_username'))
            {
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('telegram_username')]); 
            }
        }

        $validated = $validator->validated();

        // Get sponsor
        $sponsor = CustomersModel::where('referral_code', $validated['sponsor_code'])->first();
        if(!$sponsor)
        {
            return back()->withInput()->withErrors(['status_code'=>'error', 'message' => 'Please ask your mentor or referrer for Mentor ID']);
        }

        // Auto find app ID from sponsor
        $appId = $sponsor->app_id;

        // $lastSixDigits = substr($validated['wallet_address'], -6);

        $newCustomer = CustomersModel::create([
                            'app_id'        => $appId,
                            'name'          => $validated['name'],
                            'email'         => $validated['email'],
                            'phone'         => $validated['phone'] ?? null,
                            'password'      => Hash::make($validated['password']),
                            'sponsor_id'    => $sponsor->id,
                            'role'          => 'customer',
                            'telegram_username' => $validated['telegram_username'] ?? null,
                        ]);
        
        $sponsor->direct_ids = trim(($sponsor->direct_ids ?? '') . '/' . $newCustomer->id, '/');
        $sponsor->save();

        CustomerSettingsModel::create([
            'app_id'      => $appId,
            'customer_id' => $newCustomer->id,
        ]);

        $this->getCustomerFinance($newCustomer->id, $appId);

        //Temporary for testing purpose
        // $finance = $this->getCustomerFinance($newCustomer->id, $appId);
        // $finance->total_topup += 500;
        // $finance->capping_limit += (500 * 5);
        // $finance->save();
        //Temporary for testing purpose

        // $this->emailService->sendRegistrationEmail($newCustomer);
        
        // $this->showLoginForm();

        //upon registration update the levels of each upline can be done from checkLevelService only
        /*$customerUplines = $this->getUplines($newCustomer);
        foreach ($customerUplines as $upline) {
            $uplineCustomer = CustomersModel::find($upline['id']);
            if ($uplineCustomer) {
                $levelid = $this->getLevel($uplineCustomer);
                $uplineCustomer->level_id = $levelid;
                $uplineCustomer->save();
            }
        }*/

        return redirect()->route('login')->with(['status_code'=>'success', 'message' => 'Registration Successful.']);
        
    }

    public function showLoginForm()
    {
        $customer = Auth::guard('customer')->user();
        if($customer){
            return redirect()->route('dashboard');
        }

        return view('customer.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required',
            'password' => 'required',
            // 'userid'   => 'required'
        ]);

        $customer = CustomersModel::where('email', $validated['email'])->first(); //where('referral_code', $validated['userid'])->
        
        /*if (!$customer) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid credentials']);
        }
        else if (!$customer || !Hash::check($validated['password'], $customer->password)) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'Invalid credentials']);
        }*/

        if (!$customer || !Hash::check($validated['password'], $customer->password)) {
            return back()->withErrors([
                'status_code' => 'error',
                'message' => 'Invalid credentials'
            ])->withInput();
        }

        Auth::guard('customer')->login($customer); 

        $request->session()->regenerate();

        return redirect()->route('dashboard');

        // return redirect()->route('profile');
        // return redirect()->route('customer.web3login');
    }

    public function logout(Request $request)
    {
        
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

    public function showForgotPassword(Request $request)
    {
        return view('customer.forgot');
    }

    public function forgot(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);

        $customer = CustomersModel::where('email', $validated['email'])->first();

        // Generate unique reset code
        do {
            $code = strtoupper(Str::random(6));
        } while (
            ForgotPasswordRequestsModel::where('code', $code)->exists()
        );

        // Save reset request
        ForgotPasswordRequestsModel::create([
            'customer_id' => $customer->id,
            'email'       => $customer->email,
            'code'        => $code,
            'expires_at'  => now()->addMinutes(15),
        ]);

        // Create reset URL
        $resetUrl = url('/reset-password?code=' . $code);

        // Send mail
        $this->emailService->sendForgotPasswordEmail(
            $customer->email,
            $resetUrl
        );

        return back()->withInput()->withErrors(['status_code'=>'success', 'message' => 'Your forgot password request send successfully, please check you mail']);
    }

    function randomString($length = 6) 
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function showResetPasswordForm(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            // return view('customer.forgot');
            return redirect()->route('forgot')->with(['status_code'=>'error', 'message' => 'Invalid request']);
        }

        $resetRequest = ForgotPasswordRequestsModel::where('code', $code)->first();

        // Invalid or expired
        if (
            !$resetRequest ||
            $resetRequest->expires_at->isPast()
        ) {
            // return view('customer.forgot')->withErrors([
            //     'status_code' => 'error',
            //     'message' => 'Password reset link is invalid or expired.'
            // ]);

            return redirect()->route('forgot')->with(['status_code'=>'error', 'message' => 'Password reset link is invalid or expired.']);
        }

        // Valid reset link
        return view('customer.resetpassword', [
            'code' => $code,
            'customer_id' => $resetRequest->customer_id,
        ]);

        // return redirect()->route('password.reset')->with(['status_code'=>'error', 'message' => 'Password reset link is invalid or expired.']);
    }

    public function processResetPassword(Request $request)
    {
        // ✅ Validate input
        $validator = Validator::make($request->all(), [
            'cid'       => 'required|exists:customers,id',
            'ccd'       => 'required|exists:forgot_password_requests,code',
            'password'  => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) 
        {
            if($validator->errors()->get('cid'))
            {
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('cid')]); 
            }
            else if($validator->errors()->get('ccd'))
            {
                return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('ccd')]);
            }
            else if($validator->errors()->get('password'))
            {
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('password')]); 
            }
        }

        $validated = $validator->validated();

        // ✅ Fetch reset request
        $resetRequest = ForgotPasswordRequestsModel::where('code', $validated['ccd'])
                                                        ->where('customer_id', $validated['cid'])
                                                        ->first();

        // ❌ Invalid or expired
        if (!$resetRequest || $resetRequest->expires_at->isPast()) {
           return view('customer.forgot')->withErrors([
                'status_code' => 'error',
                'message' => 'Password reset link is invalid or expired.'
            ]);
        }

        // ✅ Update password
        CustomersModel::where('id', $validated['cid'])->update([
            'password' => Hash::make($validated['password']),
        ]);

        // ✅ Invalidate reset request
        $resetRequest->delete();

        return redirect()
            ->route('login')
            ->with([
                'status_code' => 'success',
                'message' => 'Password reset successfully. Please login.'
            ]);
    }

}
