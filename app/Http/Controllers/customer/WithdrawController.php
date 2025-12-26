<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CustomerWithdrawsModel;

use App\Services\WithdrawService;
use App\Services\DashboardMatriceService;

class WithdrawController extends Controller
{
    protected $withdrawServices;
    protected $dashbaord_matrice_services;

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

        return view('customer.withdraw', compact('customer'));
    }

    public function withdraw(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.0000001',
            'admin_charge' => 'required|numeric|min:0.0000001',
            'net_amount' => 'required|numeric|min:0.0000001',
        ]);  
        // dd($validated);
        $customer = Auth::guard('customer')->user();

        try {
            $withdraw = $this->withdrawServices->processWithdrawal($customer, $validated);

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
                        'message' => 'Withdraw successfully.',
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
}
