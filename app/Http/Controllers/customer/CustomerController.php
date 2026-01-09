<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Services\DashboardMatriceService;
use App\Services\GenealogyService;
use App\Services\LeadershipIncomeService;
use App\Services\LeadershipChampionsIncomeService;
use App\Services\PromotionThounsandService;
use App\Services\CheckLevelService;

use App\Traits\ManagesCustomerHierarchy;
use App\Models\AppLeadershipChampionsIncomeModel;
use App\Models\AppLeadershipIncomeModel;
use App\Models\VotesModel;
use App\Models\CustomersModel;
use App\Models\AppPromotionPackagesModel;
use App\Models\AppLevelPackagesModel;
use App\Models\AdminTutorialsModel;
use App\Models\CustomerSettingsModel;


class CustomerController extends Controller
{
    use ManagesCustomerHierarchy;

    protected $dashbaord_matrice_services;
    protected $genealogy_services;
    protected $leadership_income_services;
    protected $leadership_chamions_income_services;
    protected $check_level_service;
    protected $pk;

    public function __construct(DashboardMatriceService $dashbaord_matrice_service, GenealogyService $genealogy_service, LeadershipIncomeService $leadership_income_service, LeadershipChampionsIncomeService $leadership_chamions_income_service, PromotionThounsandService $p1000, CheckLevelService $check_level_service)
    {
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
        $this->genealogy_services = $genealogy_service;

        $this->leadership_income_services = $leadership_income_service;
        $this->leadership_chamions_income_services = $leadership_chamions_income_service;
    
        $this->pk = $p1000;
        $this->check_level_service = $check_level_service;
    }

    public function dashboard(Request $request)
    {
        // $pp = "Ordinarypeopleai@010126";
        // dd(Hash::make($pp));
        // dd($request);
        $customer = Auth::guard('customer')->user();
        // dd($customer);
        // $customerUplines = $this->getUplines($customer);
        // dd($customerUplines);
        // dd($this->getLevel($customer));

        $this->check_level_service->checkCustomerLevel($customer);

        // dd($customer);
        // $customers = CustomersModel::with('referrals')->find(10);
        // $customerUplines = $this->getUplines($customers);
        // dd($customerUplines);

        

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
        $customer->myFinance                =   $dashboard_matrics['myFinance'];

        $customer->leadership_plans         =   AppLeadershipIncomeModel::where('app_id', $customer->app_id)->get();

        $customer->champions_plans          =   AppLeadershipChampionsIncomeModel::where('app_id', $customer->app_id)->get();

        $customer->totalPoints              =   $customer->leadership_plans->sum('points') + $customer->champions_plans->sum('points');

        $customer->myVoteSumamry            =   $dashboard_matrics['myVoteSummary'];

        $customer->myVoteSumamry            =   $dashboard_matrics['myVoteSummary'];

        $customer->appData                 =   $dashboard_matrics['appData'];

        $customer->leaderBoard             =   $dashboard_matrics['leaderBoard'];

        $customer->myFreePackage           =   $dashboard_matrics['myFreePackage'];
        
        //Single champ plan for VIP circle
        // $rankIndex = is_null($customer->leadership_champions_rank) ? 0 : (int) $customer->leadership_champions_rank;
        // dd($customer);
        // $champPlan = $customer->champions_plans[$rankIndex];
        // $total_volume  = $champPlan->team_volume ?? 0;
        // $total_directs = $champPlan->directs ?? 0;
        // $customer->vip_total_volume = $total_volume;
        // $customer->vip_total_directs = $total_directs;

        // The net_amount of the assigned withdraw for withdraw success popup
        $latest_withdraw_amount = optional(
            $customer->myWithdraws->firstWhere('id', $customer->isWithdrawAssigned)
        )->net_amount ?? 0;
        $customer->latest_withdraw_amount = $latest_withdraw_amount;

        // dd($customer);


        //cumulative leadership plan for leadership leader
        $lplans = collect($customer->leadership_plans)->values();
        $lrankIndex = is_null($customer->leadership_rank)
            ? 0
            : (int) $customer->leadership_rank;
        $lcumulativePlans = $lplans->slice(0, $lrankIndex + 1);
        $customer->leader_total_volume  = $lcumulativePlans->sum('team_volume');
        $customer->leader_total_points = $lcumulativePlans->sum('points');

        //cumulative champ plan for VIP circle
        $plans = collect($customer->champions_plans)->values();
        $rankIndex = is_null($customer->leadership_champions_rank)
            ? 0
            : (int) $customer->leadership_champions_rank;

        $cumulativePlans = $plans->slice(0, $rankIndex + 1);
        $customer->vip_total_volume  = $cumulativePlans->sum('team_volume');
        $customer->vip_total_directs = $cumulativePlans->sum('directs');

                
        return view('customer.dashboard', compact('customer'));
    }

    public function showProfile()
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];
        $customer->leadership_rank          =   AppLeadershipIncomeModel::where('app_id', $customer->app_id)->where('id', $customer->leadership_rank)->value('rank');
        $customer->champions_rank           =   AppLeadershipChampionsIncomeModel::where('app_id', $customer->app_id)->where('id', $customer->leadership_champions_rank)->value('id');

        $customer->customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();

        return view('customer.profile', compact('customer'));
    }

    public function saveProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $customer_settings        =   CustomerSettingsModel::where('customer_id', $customer->id)
                                                                        ->where('app_id', $customer->app_id)
                                                                        ->first();
        /* -------------------------------
         | 1️⃣ Base rules
         --------------------------------*/
        $rules = [
            'name'        => 'required|string|max:255',
            'hdnpassword' => 'required|string',
        ];

        /* -------------------------------
         | 2️⃣ Conditional Wallet Rules
         --------------------------------*/

        if ($customer_settings->iswallet_editable && $request->filled('wallet_address')) {

            $request->merge([
                'wallet_address'        => strtolower(trim($request->wallet_address)),
                'confirm_walletaddress' => strtolower(trim($request->confirm_walletaddress ?? '')),
            ]);

            $rules['wallet_address'] = [
                'string',
                'min:40',
                'max:45',
                Rule::unique('customers')->ignore($customer->id),
            ];

            $rules['confirm_walletaddress'] = [
                'required_with:wallet_address',
                'same:wallet_address',
            ];
        }

        /* -------------------------------
         | 3️⃣ Conditional Phone Rules
         --------------------------------*/
        if ($customer_settings->isphone_editable && $request->filled('phone')) {
            $rules['phone'] = [
                'digits_between:9,15',
                Rule::unique('customers')->ignore($customer->id),
            ];
        }

        /* -------------------------------
         | 4️⃣ Profile Pic Rule (if uploaded)
         --------------------------------*/
        if ($request->hasFile('profile_pic')) {
            $rules['profile_pic'] = 'image|mimes:jpg,jpeg,png|max:2048';
        }

        /* -------------------------------
         | 5️⃣ Run Validation ONCE
         --------------------------------*/

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return back()
                    ->withInput()
                    ->withErrors($validator)   // ✅ pass validator directly
                    ->with([
                        'status_code' => 'error',
                        'message'     => $validator->errors()->first(), // first error message
                    ]);
        }

        $validated = $request->validate($rules);


        /* -------------------------------
         | 6️⃣ Password Check (manual)
         --------------------------------*/
        if (!Hash::check($validated['hdnpassword'], $customer->password)) {
            return back()
                ->withInput()
                ->withErrors([
                    'status_code' => 'error',
                    'message' => 'Incorrect password.',
                ]);
        }

        unset($validated['hdnpassword']);

        /* -------------------------------
         | 7️⃣ Handle Profile Image
         --------------------------------*/
        if ($request->hasFile('profile_pic')) {

            if ($customer->profile_image && file_exists(storage_path('app/public/' . $customer->profile_image))) {
                unlink(storage_path('app/public/' . $customer->profile_image));
            }

            $file = $request->file('profile_pic');
            $path = $file->storeAs(
                'user_profiles',
                time() . '_' . $file->getClientOriginalName(),
                'public'
            );

            $validated['profile_image'] = $path;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return back()
                ->withInput()
                ->withErrors([
                    'status_code' => 'error',
                    'message'     => $validator->errors()->first(), 
                ]);
        }

        /* -------------------------------
         | 8️⃣ Apply "Update Once" Rules
         --------------------------------*/
        $settingsDirty = false;

        if (isset($validated['wallet_address'])) {
            $customer_settings->iswallet_editable = 0;
            $settingsDirty = true;
        }

        if (isset($validated['phone'])) {
            $customer_settings->isphone_editable = 0;
            $settingsDirty = true;
        }

        if ($settingsDirty) {
            $customer_settings->save();
        }

        /* -------------------------------
         | 9️⃣ Update Customer
         --------------------------------*/
        $customer->update($validated);

        return back()
            ->with('status_code', 'success')
            ->with('message', 'Profile updated successfully!');
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
        // dd("Active",$customer->activeDirectsData);

        $allDirectIds                       =   array_filter(explode('/', $customer->direct_ids ?? ''));
        $customer->allDirectsData           =   $this->dashbaord_matrice_services->getAllDirectsData($allDirectIds);

        $customer->appData                 =   $dashboard_matrics['appData'];

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
        // dd($customer->leadershipIncome);
        $customer->myTeamData = $this->dashbaord_matrice_services->getMyTeamDataGrouped($customer->id);
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->totalTeamInvestment      =   $dashboard_matrics['totalTeamInvestment'];
        $customer->appData                 =   $dashboard_matrics['appData'];

        // dd($customer);
        return view('customer.team', compact('customer'));
    }

    public function showGenealogy()
    {
        $customer = Auth::guard('customer')->user();
        $genealogyData = $this->genealogy_services->buildGenealogyTree($customer->id);

        $dashboard_matrics  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);

        $customer->appData  =  $dashboard_matrics['appData'];

        // dd($genealogyData);
        // foreach($customer->activeDirectsData as $keys => $activeDirect)
        // {
        //     echo "<pre>"; print_r($activeDirect); echo "</pre>";
        // }
        // dd($customer->activeDirectsData);
        return view('customer.genealogy', compact('genealogyData', 'customer'));
    }

    // For Testing
    public function leadershipIncomeService(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $resp = $this->leadership_income_services->assignLeadership();
        dd($resp);
    }
    
    // For Testing
    public function leadershipChamionService(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $resp = $this->leadership_chamions_income_services->assignLeadershipchampions();
        dd($resp);
    }


    public function saveVote(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'voting_user_id'  => 'required',
            'leadership_club' => 'required',
        ]);

        // $sponsorData = CustomersModel::where('referral_code', $validated['voting_user_id'])->get();
        $is_app_customer = CustomersModel::where('referral_code', $validated['voting_user_id'])
                                            ->where('app_id', $customer->app_id)
                                            ->get();

        if(!$is_app_customer)
        {
            return back()->withInput()->with([
                                                'status_code' => 'error',
                                                'errors_data' => 'Invalid user id',
                                            ]);
        }

        $tags = [];
        if (is_string($validated['leadership_club'])) {
            $tags = json_decode($validated['leadership_club'], true);
        }

        foreach ($tags as $tag) {
            VotesModel::firstOrCreate([
                'app_id'    => $customer->app_id,
                'voter_id'  =>  $customer->id,
                'sponsor_id'=>  $is_app_customer[0]->id,
                'voted_for' =>  $tag
            ]);
        }

        return redirect()->back()->with(['status_code'=>'success', 'message'=>'Vote submitted successfully!']);
    }

    public function showPromotion()
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];

        $customer->promotionPackage         =   AppPromotionPackagesModel::where('app_id', $customer->app_id)->get();
        
        // dd($customer->promotionPackage);

        $p1_status = $this->pk->myPromotionStatus($customer, 1);

        $p2_status = $this->pk->myPromotionStatus($customer, 2);

        $p4_status = $this->pk->myPromotionStatus($customer, 4);

        // dd($p1_status, $p2_status);

        $customer->p1_status                =   $p1_status;
        $customer->p2_status                =   $p2_status;
        $customer->p4_status                =   $p4_status;

        // dd($customer->p1_status, $customer->p2_status, $customer->p4_status);

        return view('customer.promotion', compact('customer'));
    }


    public function showLevelCalculator(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $appsLevelPackages = AppLevelPackagesModel::where('app_id',$customer->app_id)->get();

        $customer->appsLevelPackages = $appsLevelPackages;

        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        
        $customer->totalActiveDirectsCount  =   $dashboard_matrics['totalActiveDirectsCount'];

        return view('customer.levelcalculator', compact('customer'));
    }


    public function showEducare(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];

        $customer->promotionPackage         =   AppPromotionPackagesModel::where('app_id', $customer->app_id)->get();
        
        return view('customer.educare', compact('customer'));
    }
    
    public function showTools(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];

        $customer->tutorials                =   AdminTutorialsModel::where('app_id', $customer->app_id)->get();
        
        return view('customer.tools', compact('customer'));
    }

    public function fetchUserName(Request $request)
    {
        $authCustomer = Auth::guard('customer')->user();
        
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $customer = CustomersModel::where('referral_code', $request->user_id)->first();

        if ($authCustomer->referral_code === $request->user_id) {
            return response()->json([
                'status'  => 'error',
                'message' => 'You cannot use your own user Id.',
            ]);
        }


        if (!$customer) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'name' => $customer->name,
        ]);
    }

    public function stopRankPopup(Request $request)
    {
        $authCustomer = Auth::guard('customer')->user();
        
        $request->validate([
            'user_id' => 'required|numeric',
        ]);

        CustomersModel::where('id', $request->user_id)
                            ->update([
                                'isRankAssigned' => 0
                            ]);

        return response()->json([
            'status' => 'success',
            'message' => "Rank popup stopped",
        ]);
    }

    public function showStats(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];




        $customer = Auth::guard('customer')->user();
        // dd($this->getLevel($customer));
        $t = $this->check_level_service->checkCustomerLevel($customer);
        // dd($t);

        // dd($customer);
        // $customers = CustomersModel::with('referrals')->find(10);
        // $customerUplines = $this->getUplines($customers);
        // dd($customerUplines);

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
        $customer->myFinance                =   $dashboard_matrics['myFinance'];

        $customer->leadership_plans         =   AppLeadershipIncomeModel::where('app_id', $customer->app_id)->get();

        $customer->champions_plans          =   AppLeadershipChampionsIncomeModel::where('app_id', $customer->app_id)->get();

        $customer->totalPoints              =   $customer->leadership_plans->sum('points') + $customer->champions_plans->sum('points');

        $customer->myVoteSumamry            =   $dashboard_matrics['myVoteSummary'];

        $customer->myVoteSumamry            =   $dashboard_matrics['myVoteSummary'];

        $customer->appData                 =   $dashboard_matrics['appData'];

        $customer->leaderBoard             =   $dashboard_matrics['leaderBoard'];

        $customer->myFreePackage           =   $dashboard_matrics['myFreePackage'];
        
        $rankIndex = is_null($customer->leadership_champions_rank) ? 0 : (int) $customer->leadership_champions_rank;

        // dd($customer);

        $customer->promotionPackage         =   AppPromotionPackagesModel::where('app_id', $customer->app_id)->get();
        
        return view('customer.stats', compact('customer'));
    }

    public function fetchTeamUserName(Request $request)
    {
        $authCustomer = Auth::guard('customer')->user();
        
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $customer = CustomersModel::where('referral_code', $request->user_id)->first();
        
        $uplines = $this->getUplines($authCustomer);
        $downlines = $this->getDownlines($authCustomer);

        $customer_team = collect($uplines)->merge($downlines);

        $name = $customer_team->firstWhere('id', $customer->id)['name'] ?? '-';

        if($name == '-')
        {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'success',
                'name' => $name,
            ]);
        }
        
    }

    public function stopWithdrawPopup(Request $request)
    {
        $authCustomer = Auth::guard('customer')->user();
        
        $request->validate([
            'user_id' => 'required|numeric',
        ]);

        CustomersModel::where('id', $authCustomer->id)
                            ->update([
                                'isWithdrawAssigned' => 0
                            ]);

        return response()->json([
            'status' => 'success',
            'message' => "Withdraw popup stopped",
        ]);
    }

}
