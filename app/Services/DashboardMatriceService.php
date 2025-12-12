<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\PackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerFinancialsModel;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomerWithdrawsModel;

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
                ->sum('amount');
        };

        $sumWithdraws = function ($ids) {
            if (empty($ids)) { return 0; }
            return DB::table('customer_withdraws')
                ->whereIn('customer_id', $ids)
                ->where('transaction_type', 'WITHDRAW') 
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
                                ->first();

        $myPackages     =   CustomerDepositsModel::select('customer_id', 'app_id', 'package_id', DB::raw('SUM(amount) as total_amount'))
                                                    ->where('customer_id', $customer->id)
                                                    ->where('app_id', $customer->app_id)
                                                    ->groupBy('customer_id', 'app_id', 'package_id')
                                                    ->get();
        
        $myPackageDeatils=   CustomerDepositsModel::select('customer_id', 'app_id', 'package_id', 'amount', 'created_at')
                                                    ->where('customer_id', $customer->id)
                                                    ->where('app_id', $customer->app_id)
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
                                                        ->where('transaction_type', 'WITHDRAW')
                                                        ->sum('amount');

        $volumes = [
            'directIds' => $directIds,
            'activeDirectIds' => $activeDirectIds,
            'allTeamIds' => $allTeamIds,
            'totalDirectInvestment'   => $sumDeposits($directIds),
            'totalActiveDirectVolume' => $sumDeposits($activeDirectIds),
            'totalTeamInvestment'     => $sumDeposits($allTeamIds),
            'totalDirectsCount'       => count($directIds),
            'totalActiveDirectsCount' => count($activeDirectIds),
            'totalTeamCount'          => count($allTeamIds),
            'myInvestment'            => $sumDeposits([$customer->id]),
            'myWithdraws'             => $sumWithdraws([$customer->id]),
            'mySponsor'               => $sponsor,
            'myFirstDepositAt'        => $veryFirstDeposit->created_at ?? 'NA',
            'myPackages'              => $myPackages ?? [],
            'myPackageDetails'        => $myPackageDeatils ?? [],
            'myFinance'               => $myFinance,
            'myLevel'                 => $level,
            'myLevelEarning'          => $myLevelEarning,
            'myTotalEarning'          => $myTotalEarning,
            'myReferralLevel'         => $referralLevel,
            'myTotalWithdraws'        => $myTotalWithdraws,
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
                                                DB::raw('MIN(customer_deposits.created_at) AS activation_date')
                                            ])
                                            ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                            
                                            // --- This is the critical filter for Active Directs ---
                                            ->whereIn('customers.id', $activeDirectIds)
                                            // ----------------------------------------------------
                                            ->where('customer_deposits.payment_status', 'success') 
                                            ->groupBy([
                                                'customers.id',
                                                'customer_deposits.customer_id', // Group by FK as well
                                                'customers.name',
                                                'customers.wallet_address',
                                                'customers.level_id',
                                                'customers.created_at',
                                                'customer_deposits.app_id',
                                                'customer_deposits.package_id'
                                            ])
                                            ->get();

        foreach($customerData as $ckey => $customerd)
        {
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
                    ->sum('amount');
            };

            $sumWithdraws = function ($ids) {
                if (empty($ids)) { return 0; }
                return DB::table('customer_withdraws')
                    ->whereIn('customer_id', $ids)
                    ->where('transaction_type', 'WITHDRAW') 
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
                                                DB::raw('SUM(customer_deposits.amount) AS totaldeposit'),
                                                DB::raw('MIN(customer_deposits.created_at) AS activation_date')
                                            ])
                                            ->leftJoin('customer_deposits', 'customers.id', '=', 'customer_deposits.customer_id')
                                            
                                            // --- This is the critical filter for Active Directs ---
                                            ->whereIn('customers.id', $allTeamIds)
                                            // ----------------------------------------------------
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
        return $customerData;
    }
}