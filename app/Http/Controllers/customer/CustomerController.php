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

// use App\Traits\ManagesCustomerHierarchy;
use App\Models\AppLeadershipChampionsIncomeModel;
use App\Models\AppLeadershipIncomeModel;
use App\Models\VotesModel;
use App\Models\CustomersModel;
use App\Models\AppPromotionPackagesModel;


class CustomerController extends Controller
{
    // use ManagesCustomerHierarchy;

    protected $dashbaord_matrice_services;
    protected $genealogy_services;
    protected $leadership_income_services;
    protected $leadership_chamions_income_services;
    
    protected $pk;

    public function __construct(DashboardMatriceService $dashbaord_matrice_service, GenealogyService $genealogy_service, LeadershipIncomeService $leadership_income_service, LeadershipChampionsIncomeService $leadership_chamions_income_service, PromotionThounsandService $p1000)
    {
        $this->dashbaord_matrice_services = $dashbaord_matrice_service;
        $this->genealogy_services = $genealogy_service;

        $this->leadership_income_services = $leadership_income_service;
        $this->leadership_chamions_income_services = $leadership_chamions_income_service;
    
        $this->pk = $p1000;
    }

    public function dashboard(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
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
        
        // dd($customer);
                
        return view('customer.dashboard', compact('customer'));
    }

    public function showProfile()
    {
        $customer = Auth::guard('customer')->user();
        $dashboard_matrics                  =   $this->dashbaord_matrice_services->showDashboardMetrics($customer->id);
        $customer->mySponsor                =   $dashboard_matrics['mySponsor'];
        $customer->leadership_rank          =   AppLeadershipIncomeModel::where('app_id', $customer->app_id)->where('id', $customer->leadership_rank)->value('rank');
        $customer->champions_rank           =   AppLeadershipChampionsIncomeModel::where('app_id', $customer->app_id)->where('id', $customer->leadership_champions_rank)->value('id');
        return view('customer.profile', compact('customer'));
    }

    public function saveProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $baseValidator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($baseValidator->fails()) {
             return back()->withInput()->withErrors(['status_code'=>'error', 'message' => $validator->errors()->get('name')]); 
        }

        $validated = $baseValidator->validated();

        // 2️⃣ Conditional rules
        $walletRules = [];

        if ($customer->iswallet_editable && $request->filled('wallet_address')) {
            $walletRules['wallet_address'] = [
                'string',
                'min:40',
                'max:45',
                Rule::unique('customers')->ignore($customer->id),
            ];
        }

        if ($customer->isphone_editable && $request->filled('phone')) {
            $walletRules['phone'] = [
                'digits_between:9,15',
                Rule::unique('customers')->ignore($customer->id),
            ];
        }

        // 3️⃣ Validate conditional fields
        if (!empty($walletRules)) 
        {
            $validator = Validator::make($request->all(), $walletRules);

            if ($validator->fails()) {
                // 👇 THIS will now show errors instead of redirecting silently
                // return back()->withErrors($validator)->withInput();
                // For debugging:
                // dd($validator->errors()->toArray());
                return back()
                        ->withInput()
                        ->with([
                            'status_code' => 'error',
                            'errors_data' => $validator->errors()->toArray(),
                        ]);
            }

            $validatedWallet = $validator->validated();

            // 4️⃣ Apply "update once" rule
            if (isset($validatedWallet['wallet_address']) && $validatedWallet['wallet_address'] !== $customer->wallet_address)
            {
                $validated['wallet_address'] = $validatedWallet['wallet_address'];
                $validated['iswallet_editable'] = 0;
            }

            if (isset($validatedWallet['phone']) && $validatedWallet['phone'] !== $customer->phone)
            {
                $validated['phone'] = $validatedWallet['phone'];
                $validated['isphone_editable'] = 0;
            }
        }

        if ($request->hasFile('profile_pic')) 
        {
            if ($customer->profile_image && file_exists(public_path($customer->profile_image))) {
                unlink(public_path($customer->profile_image)); // remove old file
            }
            // $file = $request->file('profile_pic');
            // $filename = time().'_'.$file->getClientOriginalName();
            // $path = $file->storeAs('public/user_profiles', $filename);
            // $validated['profile_image'] = str_replace('public/', 'storage/', $path); // store public URL path

            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Store in public disk
            $path = $file->storeAs('user_profiles', $filename, 'public');
            // Save only relative path
            $validated['profile_image'] = $path;

        }

        // dd($validated);

        // 5️⃣ Update only if something changed
        if (!empty($validated)) {
            $customer->update($validated);
        }

        return redirect()
            ->back()
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
        $customer->myTeamData = $this->dashbaord_matrice_services->getMyTeamDataGrouped($customer->id);
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
        $is_app_cutomer = CustomersModel::where('referral_code', $validated['voting_user_id'])
                                            ->where('app_id', $customer->app_id)
                                            ->get();

        if(!$is_app_cutomer)
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
                'sponsor_id'=>  $customer->sponsor_id,
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
        
        $p1_status = $this->pk->myPromotionStatus($customer, 1);

        $p2_status = $this->pk->myPromotionStatus($customer, 2);

        // dd($p1_status, $p2_status);

        $customer->p1_status                =   $p1_status;
        $customer->p2_status                =   $p2_status;

        return view('customer.promotion', compact('customer'));
    }

}
