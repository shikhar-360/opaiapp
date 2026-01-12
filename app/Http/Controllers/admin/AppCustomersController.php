<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\CustomersModel;
use App\Models\CustomerSettingsModel;
use App\Models\CustomerFinancialsModel;

use App\Services\Admin\AdminReportService;

class AppCustomersController extends Controller
{
    protected $adminReportService;

    public function __construct(AdminReportService $admin_report_service)
    {
        $this->adminReportService = $admin_report_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $admin = Auth::guard('admin')->user();
        // $customers = CustomersModel::where('app_id', $admin->app_id)->with('sponsor')->get();
        // return view('admins.customers.index', compact('customers'));

        $admin = Auth::guard('admin')->user();
        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'   =>  'required|date',
                'to'     =>  'required|date|after_or_equal:from',
                'search' =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $customer_details = $this->adminReportService->customerDetails($from, $to, $search);
        // dd($customer_details);
        
        return view(
            'admins.customers.index',
            compact('customer_details', 'from', 'to', 'search')
        );
    }

    public function indexFilter(Request $request)
    {
        // $admin = Auth::guard('admin')->user();
        // $customers = CustomersModel::where('app_id', $admin->app_id)->with('sponsor')->get();
        // return view('admins.customers.index', compact('customers'));

        $admin = Auth::guard('admin')->user();
        // Default dates
        $from   = now()->subDays(30)->format('Y-m-d');
        $to     = now()->format('Y-m-d');
        $search = '';

        // Validate only when form is submitted
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'from'   =>  'required|date',
                'to'     =>  'required|date|after_or_equal:from',
                'search' =>  'nullable'
            ]);

            $from           =   $validated['from'];
            $to             =   $validated['to'];
            $search         =   $validated['search'];
        }

        // Get data once
        $customer_details = $this->adminReportService->customerDetails($from, $to, $search);
        // dd($customer_details);
        // DOWNLOAD MODE
        if ($request->input('isDownload') == 1) {

            $customer_details = $customer_details->map(function ($row) {
                return [
                    'customer_name' =>    $row->name,
                    'phone'         =>    $row->phone,
                    'email'         =>    $row->email,
                    'status'        =>    $row->status,
                    'referral_code' =>    $row->referral_code,
                    'wallet_address'=>    $row->wallet_address,
                    'sponsor'       =>    $row->sponsor?->referral_code ?? '-',
                    'created_at'    =>    $row->created_at->format('d-m-Y'),
                    'activation_date'=>   optional($row->firstPaidDeposit?->created_at)->format('d-m-Y') ?? '-',
                ];
            });
            
            $columns = [                
                'Member Name'     =>  'customer_name',
                'Phone'             =>  'phone',
                'Eamil'             =>  'email',
                'Status'            =>  'status',
                'Referral Code'     =>  'referral_code',
                'Wallet Address'    =>  'wallet_address',
                'Sponsor Code'      =>  'sponsor',
                'Reg Date'          =>  'created_at',
                'Activation date'   =>  'activation_date',
            ];

            $filename = "members_{$from}_to_{$to}";

            return $this->adminReportService->exportCsv($customer_details, $columns, $filename);
        }
        
        // NORMAL VIEW MODE
        return view(
            'admins.customers.index',
            compact('customer_details', 'from', 'to', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admins.customers.create');
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
        $customer->finance = CustomerFinancialsModel::where('app_id', $admin->app_id)->where('customer_id', $id)->first();
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

        $customerFinanceRules = [
            'total_tokens'   => 'numeric|min:0'
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }

        $validated = $request->validate($rules);
        $custoemrSettingsData = $request->validate($customerSettingsRules);
        $customerFinanceData  = $request->validate($customerFinanceRules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_image')) 
        {
            $path = $request->file('profile_image')
                            ->store('user_profiles', 'public');

            $validated['profile_image'] = $path;
        }

        $customer->update($validated);

        // $customer->customerSettings()->updateOrCreate(
        //     $custoemrSettingsData
        // );
        $settings = $customer->customerSettings()->first();
        if ($settings) {
            $settings->fill($custoemrSettingsData);
            $settings->save(); 
        } 
        else 
        {
            $customer->customerSettings()->create($custoemrSettingsData); 
        }

        // $customer->customerFinance()->update(
        //     $customerFinanceData
        // );
        $finance = $customer->customerFinance()->first();
        if ($finance) 
        {
            $finance->fill($customerFinanceData);
            $finance->save(); 
        }

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
