<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Services\DepositService;
use App\Services\Payment\NinePayService;
use App\Services\LevelIncomeService;
use App\Services\DashboardMatriceService;

use App\Models\FreeDepositPackagesModel;
use App\Models\CustomersModel;
use App\Models\PackagesModel;
use App\Models\CustomerDepositsModel;

use App\Traits\ManagesCustomerFinancials;

class DepositController extends Controller
{
    protected $depositService;
    protected $ninePay;
    protected $levelIncomeServices;
    protected $dashbaord_matrice_services;

    use ManagesCustomerFinancials;

    public function __construct(DepositService $depositService, NinePayService $ninePay, LevelIncomeService $levelIncomeService, DashboardMatriceService $dashbaord_matrice_service)
    {
        $this->depositService = $depositService;
        $this->ninePay = $ninePay;
        $this->levelIncomeServices = $levelIncomeService;
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
    }

    public function showForm()
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
      
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];
        $customer->myFinance                =   $dashboard_matrics['myFinance'];
        $customer->myPackages               =   $dashboard_matrics['myPackages'];
        $customer->myPackageDetails         =   $dashboard_matrics['myPackageDetails'];

        $customer->myFreePackage            =   $dashboard_matrics['myFreePackage'];

        $customer->actualDepositCounts      =   CustomerDepositsModel::where('customer_id', $customer->id)
                                                                        ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
                                                                        ->where('is_free_deposit', 0)
                                                                        ->count();
                                                                        
        // dd($customer->myPackageDetails);
        return view('customer.pay_topup', compact('customer'));
    }

    public function deposit(Request $request)
    {
        // dd($request->all());
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            // 'package_id' => 'required|exists:app_packages,id',
            'amount'     => 'required|numeric',
            'hdn_freepackage'     => 'required|numeric',
            // 'txn_id'     => 'required|string|unique:customer_deposits,transaction_id',
        ]);

        $package = PackagesModel::where("app_id", $customer->app_id)
                                    ->where("amount", $validated['amount'])
                                    ->first();
        
        if (!$package) 
        {
            // return back()->withErrors(['amount' => 'No package found for this amount']);
            return back()->withErrors(['status_code'=>'error', 'message' => 'No package found for this amoun']);
            // return redirect()->back()->with(['status'=>'success', 'Referral code verified successfully!']);
        }

        $validated['package_id'] = $package->id;
        
        try 
        {
            
            // 1️⃣ Validate internal rules
            $package = $this->depositService
                            ->validateDepositRules($customer, $validated['package_id'], $validated['amount']);
            
            $freepackages = FreeDepositPackagesModel::where('status',1)
                                        ->where('app_id',$customer->app_id)
                                        ->where('customer_id',$customer->id)
                                        // ->where('package_id', $validated['package_id'])
                                        ->first();
            // dd($freepackages);
            $deposit = '';
            $txnId = "DEPOSIT-".Str::random(8);
            if($freepackages && $validated['hdn_freepackage'])
            {
                $txnId = "FREEPACKAGE-".$freepackages->id."-".Str::random(8); //DUMMY TXN ID
            }

            // 3️⃣ Create deposit
            $deposit = $this->depositService->createPendingDeposit($customer, $package, $validated['amount'], $txnId);
            
            // 4️⃣ Mark deposit successful
            $deposit = $this->depositService->markDepositSuccess($deposit, $validated['hdn_freepackage']);
            
            $sponsor = CustomersModel::find($customer->sponsor_id);
            $level_data = $this->levelIncomeServices->releaseLevelIncome($deposit);
            
            // return redirect()
            //         ->route('pay.topup')
            //         ->with('success', 'Deposit successfully!');

            // return redirect()
            //         ->route('pay.topup')
            //         ->with([
            //             'status'  => 'success',
            //             'message' => 'Deposit successfully!'
            //         ]);

            return redirect()->route('pay.topup')->with(['status_code'=>'success', 'message' => 'Deposit successfully.']);

        } 
        catch (\Exception $e) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => $e->getMessage()]);
            // return response()->json([
            //     'status'  => false,
            //     'message' => $e->getMessage()
            // ], 422);
        }
    }

}
