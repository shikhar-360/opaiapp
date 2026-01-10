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
use App\Models\CustomerSettingsModel;

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
                                                                        ->where('payment_status', CustomerDepositsModel::PAYMENT_STATUS_SUCCESS)
                                                                        ->where('is_free_deposit', 0)
                                                                        ->count();
        
        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();                                              
        // dd($customer->customer_settings->isFreePackage);
        return view('customer.pay_topup', compact('customer'));
    }

    public function deposit(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'amount'     => 'required|numeric'
        ]);

        $package = PackagesModel::where("app_id", $customer->app_id)
                                    ->where("amount", $validated['amount'])
                                    ->first();
        
        if (!$package) 
        {
            return back()->withErrors(['status_code'=>'error', 'message' => 'No package found for this amoun']);
        }

        $validated['package_id'] = $package->id;
        
        try 
        {
            
            // 1️⃣ Validate internal rules
            $package = $this->depositService
                            ->validateDepositRules($customer, $validated['package_id'], $validated['amount']);
            
            $deposit = '';
            $txnId = "DEPOSIT-".Str::random(8);
            
            // 3️⃣ Create deposit
            $deposit = $this->depositService->createPendingDeposit($customer, $package, $validated['amount'], $txnId);
            
            // 4️⃣ Mark deposit successful
            $deposit = $this->depositService->markDepositSuccess($deposit);
            
            $sponsor = CustomersModel::find($customer->sponsor_id);
            $level_data = $this->levelIncomeServices->releaseLevelIncome($deposit);
            
            return redirect()->route('pay.topup')->with(['status_code'=>'success', 'message' => 'Deposit successfully.']);

        } 
        catch (\Exception $e) 
        {
            return redirect()->route('pay.topup')->withErrors(['status_code'=>'error', 'message' => $e->getMessage()]);
        }
    }

    public function depositFreePackage(Request $request)
    {

        $customer = Auth::guard('customer')->user();

        try 
        {
            $package = 5;

            $freepackages   =   FreeDepositPackagesModel::where('status',0)
                                                            ->where('app_id',$customer->app_id)
                                                            ->where('customer_id',$customer->id)
                                                            ->first();
            
            
            $myPackages     =   CustomerDepositsModel::select('customer_id', 'app_id', 'package_id')
                                                            ->where('customer_id', $customer->id)
                                                            ->where('app_id', $customer->app_id)
                                                            ->where('is_free_deposit', 1)
                                                            ->first();
            // dd($freepackages, $myPackages);

            if (($customer->isFreePackage>0) && (is_null($freepackages) && is_null($myPackages))) 
            {
                $txnId = "FREEPACKAGE-".Str::random(8); //DUMMY TXN ID
                // dd($freepackages, $myPackages, $txnId);
                $deposit = $this->depositService->createFreeDeposit($customer, $package, 100000, $txnId);
                // return redirect()->route('pay.topup')->with(['status_code'=>'success', 'message' => 'Free Deposited successfully.']);
            }

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
