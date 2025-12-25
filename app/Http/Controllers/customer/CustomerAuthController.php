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
use App\Models\forgotPasswordRequestsModel;

use Illuminate\Support\Facades\Mail;

// use Elliptic\EC; 
// use kornrunner\Keccak;
use App\Services\WalletService;

use App\Traits\ManagesCustomerFinancials;

class CustomerAuthController extends Controller
{
    protected $walletServices;

    use ManagesCustomerFinancials;

    public function __construct(WalletService $walletService)
    {
        $this->walletServices = $walletService;
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
    public function showForgotPassword(Request $request)
    {

        return view('customer.forgot');
    }

    public function forgot(Request $request){
       
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:customers,email',
        ]);
        
        if ($validator->fails()) {
            if($validator->errors()->get('email')){
                 dd($validator->errors());
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('email')]); 
            }
        }
        $validated = $validator->validated();

        $user = CustomersModel::where('email', $validated['email'])->first();
        if(!$user)
        {
            return back()->withInput()->withErrors(['status_code'=>'error', 'message' => 'User not found']);
        }
        do {
            $code = $this->randomString(6);
            $exists = forgotPasswordRequestsModel::where('code', $code)->exists();
        } while ($exists);

        try {
            $mailData = array('username' => "darshana", 'portal' => 'TradeAI', 'refferal_code' => "123456", 'emailMessage' =>"dshfuisdhfui", 'email' => "darshana@360core.inc"); 

            $to_name = "darshana";
            $to_email = "darshana@360core.inc";

            $sentEmail = Mail::send('emails.forgot_otp', $mailData, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Welcome to Trade AI')
                    ->from('info@cp.vitnixx.net', 'Trade AI');
            });

            if ($sentEmail === 0) { // Check if email was sent successfully
                throw new \Exception('Email sending failed.');
            }
        } catch (\Exception $error) {
            dd($error);
        }

        forgotPasswordRequestsModel::where('user_id', $user['id'])->delete();


        forgotPasswordRequestsModel::create([
            'user_id' => $user->id,
            'code'    => $code,
            'created_at' => now(),
           
        ]);
        return back()->withInput()->withErrors(['status_code'=>'success', 'message' => 'Your forgot password request send successfully, please check you mail']);
     }
    function randomString($length = 6) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
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
               return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('sponsor_code')]); 
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
            return back()->withInput()->withErrors(['status_code'=>'error', 'message' => 'Invalid referral code']);
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

        //Temporary for testing purpose
        $finance = $this->getCustomerFinance($newCustomer->id, $appId);
        $finance->total_topup += 500;
        $finance->capping_limit += (500 * 5);
        $finance->save();
        //Temporary for testing purpose

        // $this->showLoginForm();
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
        // return redirect()->route('profile');

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