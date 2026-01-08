<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CustomerWithdrawsModel;
use App\Models\CustomerSettingsModel;

use App\Services\WithdrawService;
use App\Services\DashboardMatriceService;

use App\Traits\ManagesCustomerFinancials;

class WithdrawController extends Controller
{
    protected $withdrawServices;
    protected $dashbaord_matrice_services;

    use ManagesCustomerFinancials;
    
    public function __construct(WithdrawService $withdrawService, DashboardMatriceService $dashbaord_matrice_service)
    {
        $this->withdrawServices = $withdrawService;
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
    }

    public function showForm()
    {
        $customer = Auth::guard('customer')->user();
        
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);

        $customer->totalDirectInvestment    =   $dashboard_matrics['totalDirectInvestment'];
        $customer->totalActiveDirectVolume  =   $dashboard_matrics['totalActiveDirectVolume'];
        $customer->totalTeamInvestment      =   $dashboard_matrics['totalTeamInvestment'];
        $customer->totalDirectsCount        =   $dashboard_matrics['totalDirectsCount'];
        $customer->totalActiveDirectsCount  =   $dashboard_matrics['totalActiveDirectsCount'];
        $customer->totalTeamCount           =   $dashboard_matrics['totalTeamCount'];
        $customer->myInvestment             =   $dashboard_matrics['myInvestment'];
        $customer->myWithdraws              =   $dashboard_matrics['myWithdraws'];
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];
        $customer->myFirstDepositAt         =   $dashboard_matrics['myFirstDepositAt'];
        $customer->myLevel                  =   $dashboard_matrics['myLevel'];
        $customer->myLevelEarning           =   $dashboard_matrics['myLevelEarning'];
        $customer->myTotalEarning           =   $dashboard_matrics['myTotalEarning'];
        $customer->myPackages               =   $dashboard_matrics['myPackages'];
        $customer->myPackageDetails         =   $dashboard_matrics['myPackageDetails'];
        $customer->myReferralLevel          =   $dashboard_matrics['myReferralLevel'];
        $customer->myTotalWithdraws         =   $dashboard_matrics['myTotalWithdraws'];
        $customer->myAvailableBalance       =   $dashboard_matrics['myTotalEarning'] - $dashboard_matrics['myTotalWithdraws'];
        $customer->myWithdraws              =   $dashboard_matrics['myWithdraws'];
        $customer->appData                  =   $dashboard_matrics['appData'];
        // dd($customer->myWithdraws);
        // $withdrawDetails = CustomerWithdrawsModel::where('customer_id', $customer->id)->where('app_id', $customer->app_id)->get();

        // $customer->withdrawDetails          =   $withdrawDetails;      

        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();
        return view('customer.withdraw', compact('customer'));
    }

    public function withdraw(Request $request)
    {

        $customer = Auth::guard('customer')->user();

        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();
        if(!$customer->customer_settings->isWithdraw)
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Permission denied'
                    ]);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.0000001',
            'admin_charge' => 'required|numeric|min:0.0000001',
            'net_amount' => 'required|numeric|min:0.0000001',
        ]);  
        
        // dd($validated);
        if(!$customer->wallet_address)
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Invalid wallet address'
                    ]);
        }

        try {
            $withdraw = $this->withdrawServices->requestWithdraw($customer, $validated);

            if (isset($withdraw->original) && !$withdraw->original['status']) {
                // Both $withdraw and $withdraw->original exist, AND the status is false
                return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message'      => $withdraw->original['message']
                    ]);
            }
            
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'success',
                        'message' => 'Request submitted successfully.',
                        'withdraw_amount'=>$validated['amount']
                    ]);

        } catch (\Exception $e) {
            // return response()->json([
            //     'status'  => false,
            //     'message' => $e->getMessage(),
            // ], 400);
            return back()->withErrors(['status_code'=>'error', 'message' => $e->getMessage()]);
        }
    }

    
    public function selfTransfer(Request $request)
    {

        $customer = Auth::guard('customer')->user();

        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();
        if(!$customer->customer_settings->isSelfTransfer)
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Permission denied'
                    ]);
        }

        $validated = $request->validate([
            'self_amount' => 'required|numeric|min:0.0000001',
        ]);  
        
        $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
        // dd($finance);
        if ($finance->total_income < $validated['self_amount']) 
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Insufficient income balance.'
                    ]);
        }

        $withdraw = $this->withdrawServices->requestSelfTransfer($customer, $validated);
        
        return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'success',
                        'message' => 'Self Transfered Successfully.'
                    ]);
    }

    public function p2pTransfer(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();
        if(!$customer->customer_settings->isP2P)
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Permission denied'
                    ]);
        }
        
                                                                
        $validated = $request->validate([
            'p2p_amount' => 'required|numeric|min:0.0000001',
            'team_user_id' => 'required|string|min:6'
        ]);  
        
        $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
        // dd($finance);
        if ($finance->total_income < $validated['p2p_amount']) 
        {
            return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'error',
                        'message' => 'Insufficient income balance.'
                    ]);
        }

        $withdraw = $this->withdrawServices->requestP2PTransfer($customer, $validated);
        
        return redirect()
                    ->route('withdraw')
                    ->with([
                        'status_code'  => 'success',
                        'message' => 'Transfered P2P Successfully.'
                    ]);
    }
}
