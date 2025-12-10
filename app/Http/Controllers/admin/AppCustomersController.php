<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\CustomersModel;

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
        return view('admins.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $customer = CustomersModel::where('app_id', $admin->app_id)->findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'numeric|min:10',
            // 'wallet_address' => 'required|string|max:255|unique:customers',
            'status' => 'required|numeric|min:0',
            'referral_code'  => 'nullable|string|max:50',
            // 'sponsor_id' => 'required|numeric|min:0',
            // 'direct_ids' => 'required|numeric|min:0',
            // 'active_direct_ids' => 'required|numeric|min:0',
            // 'level_id' => 'required|numeric|min:0',
        ]);

        $rules['wallet_address'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('customers')->ignore($id), 
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }
        
        $validated = $request->validate($rules);

        $validated['password'] = Hash::make($validated['password']);

        if (empty($validated['referral_code']) && !empty($validated['wallet_address'])) 
        {
            $lastSixDigits = substr($validated['wallet_address'], -6);
            $validated['referral_code'] = $lastSixDigits;
        }
        
        $customer->update($validated);

        return redirect()->route('admin.appcustomers.index')
                         ->with('success', 'Package updated successfully.');
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
