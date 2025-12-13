<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Services\DashboardMatriceService;
use App\Services\GenealogyService;
use App\Services\LeadershipIncomeService;
use App\Services\LeadershipChampionsIncomeService;

class CustomerController extends Controller
{
    protected $dashbaord_matrice_services;
    protected $genealogy_services;
    protected $leadership_income_services;
    protected $leadership_chamions_income_services;
    public function __construct(DashboardMatriceService $dashbaord_matrice_service, GenealogyService $genealogy_service, LeadershipIncomeService $leadership_income_service, LeadershipChampionsIncomeService $leadership_chamions_income_service)
    {
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
        $this->genealogy_services = $genealogy_service;

        $this->leadership_income_services = $leadership_income_service;
        $this->leadership_chamions_income_services = $leadership_chamions_income_service;
    }

    public function dashboard(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);

        // dd($dashboard_matrics);

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
        
        return view('customer.dashboard', compact('customer'));
    }

    public function showProfile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }

    public function saveProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            // 'phone' => 'required|numeric|min:10',
        ]);

        $walletRules['phone'] = [
            'required',
            'numeric',
            'min:10',
            Rule::unique('customers')->ignore($customer->id), 
        ];
        
        $validatedWallet = $request->validate($walletRules);
        
        $validated = array_merge($validated, $validatedWallet);

        // dd($validated);
        
        // if ($request->filled('password')) {
        //     $rules['password'] = 'string|min:6';
        // }
        // $validated['password'] = Hash::make($validated['password']);

        // if (empty($customer->referral_code) && !empty($validated['wallet_address'])) 
        // {
        //     $lastSixDigits = substr($validated['wallet_address'], -6);
        //     $validated['referral_code'] = $lastSixDigits;
        // }
        
        $test = $customer->update($validated);
        
        return view('customer.profile', compact('customer'));
    }

    public function showDirects()
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        // dd($dashboard_matrics);
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

        $activeDirectIds                    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
        $customer->activeDirectsData        =   $this->dashbaord_matrice_services->getActiveDirectsData($activeDirectIds);

        $allDirectIds                       =   array_filter(explode('/', $customer->direct_ids ?? ''));
        
        $customer->allDirectsData           =   $this->dashbaord_matrice_services->getAllDirectsData($allDirectIds);

        // dd("All",$customer->allDirectsData);
        // foreach($customer->activeDirectsData as $keys => $activeDirect)
        // {
        //     echo "<pre>"; print_r($activeDirect); echo "</pre>";
        // }
        // dd($customer->activeDirectsData);
        return view('customer.directs', compact('customer'));
    }

    public function showMyTeam()
    {
        $customer = Auth::guard('customer')->user();
        $customer->myTeamData = $this->dashbaord_matrice_services->getMyTeamData($customer->id);
        // dd($customer->myTeamData);
        // foreach($customer->activeDirectsData as $keys => $activeDirect)
        // {
        //     echo "<pre>"; print_r($activeDirect); echo "</pre>";
        // }
        // dd($customer->activeDirectsData);
        return view('customer.team', compact('customer'));
    }

    public function showGenealogy()
    {
        $customer = Auth::guard('customer')->user();
        $genealogyData = $this->genealogy_services->buildGenealogyTree($customer->id);
        // dd($genealogyData);
        // foreach($customer->activeDirectsData as $keys => $activeDirect)
        // {
        //     echo "<pre>"; print_r($activeDirect); echo "</pre>";
        // }
        // dd($customer->activeDirectsData);
        return view('customer.genealogy', compact('genealogyData'));
    }

    // For Testing
    public function leadershipIncomeService(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $resp = $this->leadership_income_services->assignLeadership();
        dd($resp);
    }

    public function leadershipChamionService(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $resp = $this->leadership_chamions_income_services->assignLeadershipchampions();
        dd($resp);
    }

}
