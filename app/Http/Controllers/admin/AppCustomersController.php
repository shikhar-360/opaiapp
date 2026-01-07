<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\CustomersModel;
use App\Models\CustomerSettingsModel;

class AppCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $customers = CustomersModel::where('app_id', $admin->app_id)->get();
        return view('admins.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'numeric|min:10',
            'password' => 'numeric|min:6',
            'wallet_address' => 'required|string|max:255',
            'status' => 'required|numeric|min:0',
            // 'referral_code' => 'required|string|max:255',
            // 'sponsor_id' => 'required|numeric|min:0',
            // 'direct_ids' => 'required|numeric|min:0',
            // 'active_direct_ids' => 'required|numeric|min:0',
            // 'level_id' => 'required|numeric|min:0',
        ]);

        $admin = Auth::guard('admin')->user();
        
        $validated['app_id'] = $admin->app_id;

        CustomersModel::create($validated);

        return redirect()->route('admin.appcustomers.index')
                         ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = CustomersModel::where('app_id', $admin->app_id)->findOrFail($id);
        return view('admins.customers.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();
        $customer = CustomersModel::where('app_id', $admin->app_id)->findOrFail($id);
        $customer->customer_settings = CustomerSettingsModel::where('app_id', $admin->app_id)->where('customer_id', $id)->first();
        return view('admins.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $customer = CustomersModel::where('app_id', $admin->app_id)->findOrFail($id);
        // dd($request->all());
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => [
                'nullable',
                'digits_between:10,15',
                Rule::unique('customers')->ignore($id),
            ],
            'status' => 'required|numeric|min:0',
            'referral_code'  => 'nullable|string|max:50',
            'wallet_address' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('customers')->ignore($id),
            ],
            'profile_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $customerSettingsRules = [
            'isP2P'           => 'required|in:0,1',
            'isSelfTransfer'  => 'required|in:0,1',
            'isFreePackage'   => 'required|in:0,1',
            'isWithdraw'      => 'required|in:0,1',
        ];

        // $rules['wallet_address'] = [
        //     'nullable',
        //     'string',
        //     'max:255',
        //     Rule::unique('customers')->ignore($id), 
        // ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);
        $custoemrSettingsData = $request->validate($customerSettingsRules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // if (empty($validated['referral_code']) && !empty($validated['wallet_address'])) 
        // {
        //     $lastSixDigits = substr($validated['wallet_address'], -6);
        //     $validated['referral_code'] = $lastSixDigits;
        // }
        
        // dd($validated);

        if ($request->hasFile('profile_image')) 
        {
            $path = $request->file('profile_image')
                            ->store('user_profiles', 'public');

            $validated['profile_image'] = $path;
        }

        $customer->update($validated);

        $customer->customerSettings()->updateOrCreate(
            ['app_id' => $admin->app_id],
            $custoemrSettingsData
        );

        return redirect()->route('admin.appcustomers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Auth::guard('admin')->user();
        $package = CustomersModel::where('app_id', $admin->app_id)->findOrFail($id);
        $package->delete();

        return redirect()->route('admin.appcustomers.index')
                         ->with('success', 'Package deleted successfully.');
    }
}
