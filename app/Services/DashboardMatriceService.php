<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\PackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerFinancialsModel;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomerWithdrawsModel;
use App\Models\VotesModel;
use App\Models\AppsModel;
use App\Models\FreeDepositPackagesModel;


use App\Traits\ManagesCustomerHierarchy;

class DashboardMatriceService
{
    use ManagesCustomerHierarchy;
    
    public function showDashboardMetrics($customerId)
    {
        $customer = Auth::guard('customer')->user();

        // 1. Retrieve the current user's model instance to access the ID columns
        $customer = CustomersModel::find($customer->id, ['id', 'app_id', 'direct_ids', 'active_direct_ids']);
        
        if (!$customer) { return ['error' => 'Customer not found']; }

        // $levelid = $this->getLevel($customer);
        // $customer->level_id = $levelid;
        // $customer->save();

        if ($customer->id != $customerId) {
            // If the IDs don't match, stop execution and show a 403 Forbidden error
            abort(403, 'Unauthorized access to another user\'s dashboard.');
        }
        
        // --- Prepare the ID Arrays ---
        // Convert strings to arrays, filtering out potential empty entries
        $directIds = array_filter(explode('/', $customer->direct_ids ?? ''));
        $activeDirectIds = array_filter(explode('/', $customer->active_direct_ids ?? ''));
        
        // Use the trait function for all recursive team IDs
        $allTeamIds = $this->getRecursiveTeamIds($customer->id);
 
        // --- Perform Calculations ---
        // Function to safely sum deposits for a given set of IDs
        $sumDeposits = function ($ids) {
            if (empty($ids)) { return 0; }
            return DB::table('customer_deposits')
                ->whereIn('customer_id', $ids)
                ->where('payment_status', 'success') 
                ->where('is_free_deposit', 0)
                ->sum('amount');
        }; 

        $sumWithdraws = function ($ids) {
            if (empty($ids)) { return 0; }
            return DB::table('customer_withdraws')
                ->whereIn('customer_id', $ids)
                ->where('transaction_status', 'success') 
                ->sum('amount');
        };

        // ------ find the sponsor ---
        $sponsordata = CustomersModel::with('sponsor')->find($customerId);
        $sponsor = 'N/A';
        if ($sponsordata && $sponsordata->sponsor) {
            $sponsor = $sponsordata->sponsor->referral_code;
        }
        
        // ------ find the date of active ---
        $veryFirstDeposit = DB::table('customer_deposits')
                                ->where('customer_id', $customerId)
                                ->where('payment_status', 'success') 
                                ->where('is_free_deposit', 0)
                                ->first();

        $myPackages     =   CustomerDepositsModel::select('customer_id', 'app_id', 'package_id', DB::raw('SUM(amount) as total_amount'))
                                                    ->where('customer_id', $customer->id)
                                                    ->where('app_id', $customer->app_id)
                                                    ->where('package_id', '!=', 5)
                                                    ->groupBy('customer_id', 'app_id', 'package_id')
                                                    ->get();
        
        $myPackageDeatils=   CustomerDepositsModel::select('customer_id', 'app_id', 'package_id', 'amount', 'created_at')
                                                    ->where('customer_id', $customer->id)
                                                    ->where('app_id', $customer->app_id)
                                                    // ->where('package_id', '!=', 5)
                                                    ->get();

        $myFinance      = CustomerFinancialsModel::firstOrCreate([
                                                        'customer_id' => $customer->id,
                                                        'app_id' => $customer->app_id
                                                    ]);

        $myLevelEarning = CustomerEarningDetailsModel::where('customer_id', $customer->id)
                                                        ->where('app_id', $customer->app_id)
                                                        ->where('earning_type', 'LEVEL-REWARD')
                                                        ->sum('amount_earned');

        $myTotalEarning = CustomerEarningDetailsModel::where('customer_id', $customer->id)
                                                        ->where('app_id', $customer->app_id)
                                                        ->sum('amount_earned');
        $level          =   $this->getLevel($customer);

        $referralLevel  =   $this->getLevel($sponsordata);
        
        $myTotalWithdraws = CustomerWithdrawsModel::where('customer_id', $customer->id)
                                                        ->where('app_id', $customer->app_id)
                                                        ->where('transaction_status', 'success')
                                                        ->sum('amount');
        
        $myWithdraws    =   CustomerWithdrawsModel::where('customer_id', $customer->id)
                                                        ->where('app_id', $customer->app_id)
                                                        ->where('transaction_status', 'success')
                                                        ->get();

        $voteTypes      = ['HONEST', 'ACTIVE', 'HELPFULL'];
        $myVoteSummary  = VotesModel::where('sponsor_id', $customer->id)
                                            ->where('app_id', $customer->app_id)
                                            ->select('voted_for', \DB::raw('COUNT(*) as total_votes'))
                                            ->groupBy('voted_for')
                                            ->pluck('total_votes', 'voted_for'); 

        $voteResult = collect($voteTypes)->mapWithKeys(function ($type) use ($myVoteSummary) {
            return [$type => $myVoteSummary[$type] ?? 0];
        });
        
        $myVoteSummary  =   ['HONEST'=>$voteResult['HONEST'], 'ACTIVE'=>$voteResult['ACTIVE'], 'HELPFULL'=>$voteResult['HELPFULL']];


        $appData       =   AppsModel::where('id',$customer->app_id)->first();

        // Votes Today
        $dailyVote          =   $this->votesSummaryByRange(Carbon::today());
        // Votes In Last 7 Days
        $weeklyVote         =   $this->votesSummaryByRange(Carbon::now()->subDays(7));
        // Votes In Last 30 Days
        $monthlyVote        =   $this->votesSummaryByRange(Carbon::now()->subDays(30));


        // Volume Today
        $dailyVolume          =   $this->volumeSummaryByRange(Carbon::today());
        // volume In Last 7 Days
        $weeklyVolume         =   $this->volumeSummaryByRange(Carbon::now()->subDays(7));
        // Volume In Last 30 Days
        $monthlyVolume        =   $this->volumeSummaryByRange(Carbon::now()->subDays(30));


        // Directs Today
        $dailyDirects         =   $this->directsByRange(Carbon::today());
        // volume In Last 7 Days
        $weeklyDirects        =   $this->directsByRange(Carbon::now()->subDays(7));
        // Volume In Last 30 Days
        $monthlyDirects       =   $this->directsByRange(Carbon::now()->subDays(30));


        $freepackages         =   FreeDepositPackagesModel::where('status',1)
                                        ->where('app_id',$customer->app_id)
                                        ->where('customer_id',$customer->id)
                                        ->where('package_id', '!=', 5)
                                        ->first();

        $volumes = [
            'directIds'               => $directIds,
            'activeDirectIds'         => $activeDirectIds,
            'allTeamIds'              => $allTeamIds,
            'totalDirectInvestment'   => $sumDeposits($directIds),
            'totalActiveDirectVolume' => $sumDeposits($activeDirectIds),
            'totalTeamInvestment'     => $sumDeposits($allTeamIds),
            'totalDirectsCount'       => count($directIds),
            'totalActiveDirectsCount' => count($activeDirectIds),
            'totalTeamCount'          => count($allTeamIds),
            'myInvestment'            => $sumDeposits([$customer->id]),
            'myWithdraws'             => $sumWithdraws([$customer->id]),
            'mySponsor'               => $sponsor,
            'myFirstDepositAt'        => $veryFirstDeposit ? Carbon::parse($veryFirstDeposit->created_at) : null, //$veryFirstDeposit->created_at ?? 'NA',
            'myPackages'              => $myPackages ?? [],
            'myPackageDetails'        => $myPackageDeatils ?? [],
            'myFinance'               => $myFinance,
            'myLevel'                 => $level,
            'myLevelEarning'          => $myLevelEarning,
            'myTotalEarning'          => $myTotalEarning,
            'myReferralLevel'         => $referralLevel,
            'myTotalWithdraws'        => $myTotalWithdraws,
            'myWithdraws'             => $myWithdraws,
            'myVoteSummary'           => $voteResult,
            'appData'                 => $appData,
            'leaderBoard'             => array(
                                                "votes" => array("daily"=>$dailyVote,"weekly"=>$weeklyVote,"monthly"=>$monthlyVote),
                                                "volume" => array("daily"=>$dailyVolume,"weekly"=>$weeklyVolume,"monthly"=>$monthlyVolume),
                                                "directs" => array("daily"=>$dailyDirects,"weekly"=>$weeklyDirects,"monthly"=>$monthlyDirects),
                                            ),
            'myFreePackage'           => $freepackages,
        ];

        return $volumes;
    }

    public function getActiveDirectsData(array $activeDirectIds)
    {
        $customer = Auth::guard('customer')->user();
        // Ensure we have IDs to query, otherwise return an empty collection
        if (empty($activeDirectIds)) {
            return collect();
        }

        $customerData = CustomersModel::select([
                                                'customers.id',
                                                'customer_deposits.customer_id',
                                                'customers.name',
                                                'customers.wallet_address',
                                                'customers.level_id',
                                                'customers.created_at AS registration_date',
                                                'customer_deposits.app_id',
                                                'customer_deposits.package_id',
                                                DB::raw('SUM(customer_deposits.amount) AS totaldeposit'),
                                                DB::raw('MIN(customer_deposits.created_at) AS activation_date'),
                                                'customers.referral_code'
                                            ])
                                            ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                            
                                            // --- This is the critical filter for Active Directs ---
                                            ->whereIn('customers.id', $activeDirectIds)
                                            // ----------------------------------------------------
                                            ->where('customer_deposits.payment_status', 'success') 
                                            ->where('customer_deposits.is_free_deposit', 0)
                                            ->groupBy([
                                                'customers.id',
                                                'customer_deposits.customer_id', // Group by FK as well
                                                'customers.name',
                                                'customers.wallet_address',
                                                'customers.level_id',
                                                'customers.created_at',
                                                'customer_deposits.app_id',
                                                'customer_deposits.package_id',
                                                'customers.referral_code'
                                            ])
                                            ->get();

        foreach($customerData as $ckey => $customerd)
        {
            // $customerData[$ckey]['level_id'] = $this->getLevel($customerd);

            $customerdd = CustomersModel::find($customerd['id'], ['id', 'direct_ids', 'active_direct_ids']);
            
            if (!$customerdd) { return ['error' => 'Customer not found']; }

            $customerData[$ckey]['level_id'] = $customerdd->level_id;

            // --- Prepare the ID Arrays ---
            // Convert strings to arrays, filtering out potential empty entries
            $directIds = array_filter(explode('/', $customerdd->direct_ids ?? ''));
            $activeDirectIds = array_filter(explode('/', $customerdd->active_direct_ids ?? ''));
            
            // Use the trait function for all recursive team IDs
            $allTeamIds = $this->getRecursiveTeamIds($customerdd->id);
            
            // --- Perform Calculations ---
            // Function to safely sum deposits for a given set of IDs
            $sumDeposits = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_deposits')
                    ->whereIn('customer_id', $ids)
                    ->where('payment_status', 'success') 
                    ->where('is_free_deposit', 0)
                    ->sum('amount');
            };

            $sumWithdraws = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_withdraws')
                    ->whereIn('customer_id', $ids)
                    ->where('transaction_status', 'success') 
                    ->sum('amount');
            };

            // ------ find the sponsor ---
            $sponsordata = CustomersModel::with('sponsor')->find($customerdd->id);
            $sponsor = 'N/A';
            if ($sponsordata && $sponsordata->sponsor) {
                $sponsor = $sponsordata->sponsor->referral_code;
            }
            
            $customerData[$ckey]['totalDirectsCount']       = count($directIds);
            $customerData[$ckey]['totalActiveDirectsCount'] = count($activeDirectIds);
            $customerData[$ckey]['totalTeamCount']          = count($allTeamIds);
        }

        return $customerData;
    }
    
    public function getMyTeamDataGrouped($customerId)
    {
        $customer = Auth::guard('customer')->user();
        $allTeamIds = $this->getRecursiveTeamIds($customerId);
        
        // dd($allTeamIds);

        // $customerData = CustomersModel::select([
        //                                         'customers.id',
        //                                         'customer_deposits.customer_id',
        //                                         'customers.name',
        //                                         'customers.wallet_address',
        //                                         'customers.level_id',
        //                                         'customers.referral_code',
        //                                         'customers.sponsor_id',
        //                                         'customers.created_at AS registration_date',
        //                                         'customer_deposits.app_id',
        //                                         'customer_deposits.package_id',
        //                                         'customers.leadership_rank',
        //                                         'customers.leadership_points',
        //                                         'customers.leadership_champions_rank',
        //                                         DB::raw('SUM(customer_deposits.amount) AS totaldeposit'),
        //                                         DB::raw('MIN(customer_deposits.created_at) AS activation_date'),
        //                                     ])
        //                                     ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                            
        //                                     // --- This is the critical filter for Active Directs ---
        //                                     ->whereIn('customers.id', $allTeamIds)
        //                                     // ----------------------------------------------------
        //                                     ->where('customer_deposits.payment_status', 'success') 
        //                                     ->groupBy([
        //                                         'customers.id',
        //                                         'customer_deposits.customer_id', // Group by FK as well
        //                                         'customers.name',
        //                                         'customers.wallet_address',
        //                                         'customers.level_id',
        //                                         'customers.sponsor_id',
        //                                         'customers.referral_code',
        //                                         'customers.created_at',
        //                                         'customers.leadership_rank',
        //                                         'customers.leadership_points',
        //                                         'customers.leadership_champions_rank',
        //                                         'customer_deposits.app_id',
        //                                         'customer_deposits.package_id'
        //                                     ])
        //                                     ->get();

        $customerData = CustomersModel::with([
                                                'leadershipIncome',
                                                'leadershipChampionsIncome',
                                                'customerDeposits' => function($query) {
                                                    $query->where('payment_status', 'success');
                                                }
                                            ])
                                            ->withSum(['customerDeposits as totaldeposit' => function($query) {
                                                $query->where('payment_status', 'success');
                                            }], 'amount')
                                            ->withMin(['customerDeposits as activation_date' => function($query) {
                                                $query->where('payment_status', 'success');
                                            }], 'created_at')
                                            ->whereIn('customers.id', $allTeamIds)
                                            ->get();
                                        
        $sponsorIds = $customerData->pluck('sponsor_id')->unique()->filter()->toArray();
        $sponsors = CustomersModel::whereIn('id', $sponsorIds)->pluck('referral_code', 'id');


        $customerData = $customerData->map(function ($record) use ($sponsors) {
            // Look up the referral code using the sponsor_id we already fetched
            $sponsorId = $record->sponsor_id;
            // Add a new dynamic attribute 'sponsor_referral_code' to the result object
            $record->sponsor_code = $sponsors->get($sponsorId, 'N/A');
            return $record;
        });


        foreach($customerData as $ckey => $customerd)
        {
            // $customerData[$ckey]['level_id'] = $this->getLevel($customerd);

            $customerdd = CustomersModel::find($customerd['id'], ['id', 'direct_ids', 'active_direct_ids']);
            
            if (!$customerdd) { return ['error' => 'Customer not found']; }

            $customerData[$ckey]['level_id'] = $customerdd->level_id;

            // --- Prepare the ID Arrays ---
            // Convert strings to arrays, filtering out potential empty entries
            $directIds = array_filter(explode('/', $customerdd->direct_ids ?? ''));
            $activeDirectIds = array_filter(explode('/', $customerdd->active_direct_ids ?? ''));
            
            // Use the trait function for all recursive team IDs
            $allTeamIds = $this->getRecursiveTeamIds($customerdd->id);
            
            // --- Perform Calculations ---
            // Function to safely sum deposits for a given set of IDs
            $sumDeposits = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_deposits')
                    ->whereIn('customer_id', $ids)
                    ->where('payment_status', 'success') 
                    ->where('is_free_deposit', 0)
                    ->sum('amount');
            };

            $sumWithdraws = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_withdraws')
                    ->whereIn('customer_id', $ids)
                    ->where('transaction_status', 'success') 
                    ->sum('amount');
            };

            // ------ find the sponsor ---
            $sponsordata = CustomersModel::with('sponsor')->find($customerdd->id);
            $sponsor = 'N/A';
            if ($sponsordata && $sponsordata->sponsor) {
                $sponsor = $sponsordata->sponsor->referral_code;
            }
            
            $customerData[$ckey]['totalDirectsCount']       = count($directIds);
            $customerData[$ckey]['totalActiveDirectsCount'] = count($activeDirectIds);
            $customerData[$ckey]['totalTeamCount']          = count($allTeamIds);
            $customerData[$ckey]['totalTeamInvestment']     = $sumDeposits($activeDirectIds);
        }


        return $customerData;
    }

    public function getMyTeamData($customerId)
    {
        $customer = Auth::guard('customer')->user();
        $allTeamIds = $this->getRecursiveTeamIds($customerId);
        
        // dd($allTeamIds);

        $customerData = CustomersModel::select([
                                                'customers.id',
                                                'customer_deposits.customer_id',
                                                'customers.name',
                                                'customers.wallet_address',
                                                'customers.level_id',
                                                'customers.referral_code',
                                                'customers.sponsor_id',
                                                'customers.created_at AS registration_date',
                                                'customer_deposits.app_id',
                                                'customer_deposits.package_id',
                                                'customer_deposits.amount AS totaldeposit',
                                                'customer_deposits.created_at AS activation_date'
                                            ])
                                            ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                            ->whereIn('customers.id', $allTeamIds)
                                            ->where('customer_deposits.payment_status', 'success') 
                                            ->where('customer_deposits.is_free_deposit', 0)
                                            ->get();
        $sponsorIds = $customerData->pluck('sponsor_id')->unique()->filter()->toArray();
        $sponsors = CustomersModel::whereIn('id', $sponsorIds)->pluck('referral_code', 'id');


        $customerData = $customerData->map(function ($record) use ($sponsors) {
            // Look up the referral code using the sponsor_id we already fetched
            $sponsorId = $record->sponsor_id;
            // Add a new dynamic attribute 'sponsor_referral_code' to the result object
            $record->sponsor_code = $sponsors->get($sponsorId, 'N/A');
            return $record;
        });

        foreach($customerData as $customerd) 
        {
            $customerd->level_id = $this->getLevel($customerd); 
        }

        return $customerData;
    }

    public function getAllDirectsData(array $allDirectIds)
    {
        $customer = Auth::guard('customer')->user();
        // Ensure we have IDs to query, otherwise return an empty collection
        if (empty($allDirectIds)) {
            return collect();
        }

        /*$customerData = CustomersModel::select([
                                                    'customers.id',
                                                    'customer_deposits.customer_id',
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.created_at AS registration_date',
                                                    'customer_deposits.app_id',
                                                    'customer_deposits.package_id',
                                                    'customers.referral_code',
                                                    DB::raw('SUM(customer_deposits.amount) AS totaldeposit'),
                                                    DB::raw('MIN(customer_deposits.created_at) AS activation_date'),
                                                ])
                                                // ->leftJoin('customer_deposits', function ($join) {
                                                //     $join->on('customers.id', '=', 'customer_deposits.customer_id')
                                                //         ->where('customer_deposits.payment_status', '=', 'success');
                                                // })
                                                ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                                ->whereIn('customers.id', $allDirectIds)
                                                ->where('customer_deposits.payment_status', 'success') 
                                                ->groupBy([
                                                    'customers.id',
                                                    'customer_deposits.customer_id', // Group by FK as well
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.sponsor_id',
                                                    'customers.referral_code',
                                                    'customers.created_at',
                                                    'customer_deposits.app_id',
                                                    'customer_deposits.package_id'
                                                ])
                                                ->get();*/

        /*$customerData = CustomersModel::select([
                                                    'customers.id',
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.created_at AS registration_date',
                                                    'customers.referral_code',
                                                    'customers.leadership_champions_rank',
                                                    DB::raw('COALESCE(SUM(customer_deposits.amount), 0) AS totaldeposit'),
                                                    DB::raw('MIN(customer_deposits.created_at) AS activation_date'),
                                                ])
                                                ->leftJoin('customer_deposits', function ($join) {
                                                    $join->on('customers.id', '=', 'customer_deposits.customer_id')
                                                         ->where('customer_deposits.payment_status', 'success')
                                                         ->where('customer_deposits.is_free_deposit', 0);
                                                })
                                                ->whereIn('customers.id', $allDirectIds)
                                                ->groupBy([
                                                    'customers.id',
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.referral_code',
                                                    'customers.created_at',
                                                    'customers.leadership_champions_rank'
                                                ])
                                                ->get();*/

        $customerData = CustomersModel::select([
                                                    'customers.id',
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.created_at AS registration_date',
                                                    'customers.referral_code',
                                                    'customers.leadership_champions_rank',
                                                    DB::raw('COALESCE(SUM(customer_deposits.amount), 0) AS totaldeposit'),
                                                    DB::raw('MIN(customer_deposits.created_at) AS activation_date'),
                                                ])
                                                ->leftJoin('customer_deposits', function ($join) {
                                                    $join->on('customers.id', '=', 'customer_deposits.customer_id')
                                                        ->where('customer_deposits.payment_status', 'success')
                                                        ->where('customer_deposits.is_free_deposit', 0);
                                                })
                                                ->whereIn('customers.id', $allDirectIds)
                                                ->groupBy([
                                                    'customers.id',
                                                    'customers.name',
                                                    'customers.wallet_address',
                                                    'customers.level_id',
                                                    'customers.referral_code',
                                                    'customers.created_at',
                                                    'customers.leadership_champions_rank'
                                                ])
                                                ->get();
        $customerData->load('customerDeposits');

        foreach($customerData as $ckey => $customerd)
        {
            $customerData[$ckey]['level_id'] = $this->getLevel($customerd);

            $customerdd = CustomersModel::find($customerd['id'], ['id', 'direct_ids', 'active_direct_ids']);
        
            if (!$customerdd) { return ['error' => 'Customer not found']; }

            // --- Prepare the ID Arrays ---
            // Convert strings to arrays, filtering out potential empty entries
            $directIds = array_filter(explode('/', $customerdd->direct_ids ?? ''));
            $activeDirectIds = array_filter(explode('/', $customerdd->active_direct_ids ?? ''));
            
            // Use the trait function for all recursive team IDs
            $allTeamIds = $this->getRecursiveTeamIds($customerdd->id);
            
            // --- Perform Calculations ---
            // Function to safely sum deposits for a given set of IDs
            $sumDeposits = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_deposits')
                    ->whereIn('customer_id', $ids)
                    ->where('payment_status', 'success') 
                    ->where('is_free_deposit', 0)
                    ->sum('amount');
            };

            $sumWithdraws = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_withdraws')
                    ->whereIn('customer_id', $ids)
                    ->where('transaction_status', 'success') 
                    ->sum('amount');
            };

            // ------ find the sponsor ---
            $sponsordata = CustomersModel::with('sponsor')->find($customerdd->id);
            $sponsor = 'N/A';
            if ($sponsordata && $sponsordata->sponsor) {
                $sponsor = $sponsordata->sponsor->referral_code;
            }
            
            $customerData[$ckey]['totalDirectsCount']       = count($directIds);
            $customerData[$ckey]['totalActiveDirectsCount'] = count($activeDirectIds);
            $customerData[$ckey]['totalTeamCount']          = count($allTeamIds);
            $customerData[$ckey]['totalTeamInvestment']     = $sumDeposits($activeDirectIds);
        }


        return $customerData;
    }

    function votesSummaryByRange($fromDate)
    {
        $customer = Auth::guard('customer')->user();
        // return VotesModel::with('sponsor:id,referral_code')
        //     ->select(
        //         'sponsor_id',
        //         DB::raw("SUM(CASE WHEN voted_for = 'ACTIVE' THEN 1 ELSE 0 END) AS active"),
        //         DB::raw("SUM(CASE WHEN voted_for = 'HELPFULL' THEN 1 ELSE 0 END) AS helpfull"),
        //         DB::raw("SUM(CASE WHEN voted_for = 'HONEST' THEN 1 ELSE 0 END) AS honest"),
        //         DB::raw("COUNT(*) AS total_votes")
        //     )
        //     ->where('created_at', '>=', $fromDate)
        //     ->where('app_id', $customer->app_id)
        //     ->groupBy('sponsor_id')
        //     ->get()
        //     ->map(function ($row) {
        //         $row->referral_code = $row->sponsor->referral_code ?? null;
        //         unset($row->sponsor);
        //         return $row;
        //     });

        return VotesModel::with('sponsor:id,referral_code,name')
                            ->select(
                                'sponsor_id',
                                DB::raw("SUM(CASE WHEN voted_for = 'ACTIVE' THEN 1 ELSE 0 END) AS active"),
                                DB::raw("SUM(CASE WHEN voted_for = 'HELPFULL' THEN 1 ELSE 0 END) AS helpfull"),
                                DB::raw("SUM(CASE WHEN voted_for = 'HONEST' THEN 1 ELSE 0 END) AS honest"),
                                DB::raw("COUNT(*) AS total_votes")
                            )
                            ->where('created_at', '>=', $fromDate)
                            ->where('app_id', $customer->app_id)
                            ->groupBy('sponsor_id')
                            ->orderByDesc('total_votes')   // 👈 DESCENDING ORDER
                            ->get()
                            ->map(function ($row) {
                                $row->referral_code = $row->sponsor->referral_code ?? null;
                                $row->name          = $row->sponsor->name ?? null;
                                unset($row->sponsor);
                                return $row;
                            });
    }

    function volumeSummaryByRange($fromDate)
    {
        $customer = Auth::guard('customer')->user();

        $packageIds = PackagesModel::where('app_id', $customer->app_id)
                                            ->pluck('id')
                                            ->toArray();
        
        $selects = [
                        'customers.name',
                        'customers.referral_code',
                        'customer_deposits.customer_id',
                    ];

        foreach ($packageIds as $pid) {
            $selects[] = DB::raw(
                "SUM(CASE WHEN package_id = {$pid} THEN amount ELSE 0 END) AS package_{$pid}"
            );
        }

        // total volume
        $selects[] = DB::raw("SUM(amount) AS total");

        // $volumeSummary = CustomerDepositsModel::join(
        //                                                 'customers',
        //                                                 'customers.id',
        //                                                 '=',
        //                                                 'customer_deposits.customer_id'
        //                                             )
        //                                             ->select($selects)
        //                                             ->where('customer_deposits.payment_status', 'success')
        //                                             ->where('customer_deposits.created_at', '>=', $fromDate)
        //                                             ->where('customer_deposits.app_id', $customer->app_id)
        //                                             ->groupBy(
        //                                                 'customer_deposits.customer_id',
        //                                                 'customers.referral_code'
        //                                             )
        //                                             ->orderBy('customer_deposits.customer_id')
        //                                             ->orderByRaw('SUM(customer_deposits.amount) DESC')
        //                                             ->get();


        $baseQuery = CustomerDepositsModel::join(
                        'customers',
                        'customers.id',
                        '=',
                        'customer_deposits.customer_id'
                    )
                    ->select($selects) // includes SUM(amount) AS total
                    ->where('customer_deposits.payment_status', 'success')
                    ->where('customer_deposits.created_at', '>=', $fromDate)
                    ->where('customer_deposits.app_id', $customer->app_id)
                    ->where('customer_deposits.is_free_deposit', 0)
                    ->groupBy(
                        'customer_deposits.customer_id',
                        'customers.referral_code',
                        'customers.name'
                    );

        $volumeSummary = DB::query()
                            ->fromSub($baseQuery, 'volume_summary')
                            ->orderByDesc('total')
                            ->get();

        return $volumeSummary;
    }


    function directsByRange($fromDate)
    {
        $customer = Auth::guard('customer')->user();

        /*
        $activeDirectCounts = CustomersModel::select(
            'id',
            'referral_code',
            'active_direct_ids',
            DB::raw("
                LENGTH(active_direct_ids) 
                - LENGTH(REPLACE(active_direct_ids, '/', '')) 
                + 1 AS active_direct_count
            ")
        )
        ->whereNotNull('active_direct_ids')
        ->where('active_direct_ids', '!=', '')
        ->get();
        */

        $customers = CustomersModel::whereNotNull('active_direct_ids')->where('app_id',$customer->app_id)->get();

        return $customers->map(function ($row) {
                                                $row->active_direct_count = count(
                                                    array_filter(explode('/', $row->active_direct_ids))
                                                );
                                                return $row;
                                            })->sortByDesc('active_direct_count');
        
        
        

        
    }
}