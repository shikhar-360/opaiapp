<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppsModel;
use App\Models\CustomersModel;
use App\Models\AppPromotionPackagesModel;
use App\Models\CustomerDepositsModel;

class PromotionThounsandService
{
    
    public function assignPromotionThousand($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        $customers = CustomersModel::where("app_id", $app->id)->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            $promotion_status_array = $customer->promotion_status;

            if (is_string($promotion_status_array)) {
                $promotion_status_array = json_decode($promotion_status_array, true);
            }

            // Still not array? Reset
            if (!is_array($promotion_status_array)) {
                $promotion_status_array = [];
            }

            $packageCounts = [];
            $activeDirectIds = [];
            $leadershipChampionsRank = [];

            if(!$customer->active_direct_ids)
            {
                continue;
            }
            
            $activeDirectIds    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
            
            // dd($activeDirectIds);

            if (empty($activeDirectIds)) {
                continue;
            }

            $leadershipChampionsRank = AppPromotionPackagesModel::where('app_id', $app->id)
                                                                            ->where('app_id', $customer->app_id)
                                                                            ->where('id', 1)
                                                                            ->first();
            $leadershipChampionsRankArray = $leadershipChampionsRank['package']; //json_decode($leadershipChampionsRank['package'], true);

            

            $allDirects = CustomerDepositsModel::select('*')
                                                    ->selectRaw('MIN(created_at) OVER (PARTITION BY customer_id, amount) as earliest_deposit_date')
                                                    ->whereIn('customer_id', $activeDirectIds)
                                                    ->where('payment_status', 'success')
                                                    ->where('is_free_deposit', 0)
                                                    ->whereIn('amount', $leadershipChampionsRankArray)
                                                    ->get();
            
            //Cast the amount to integer
            $allDirects = $allDirects->map(function ($row) {
                                            $row->amount = (int) $row->amount;
                                            return $row;
                                        });

            // count the pkg deposited 
            $packageCounts = $allDirects->groupBy('amount')
                                                ->map(fn ($rows) => $rows->groupBy('customer_id')->count());

            //calculate total and add 0 for the missing packages                                                
            $totalPkgCounts = 0;                                                
            foreach($leadershipChampionsRankArray as $pkg)
            {
                if (!$packageCounts->has($pkg)) 
                {
                    $packageCounts[$pkg] = 0;
                }

                $totalPkgCounts += $packageCounts[$pkg];
            }

            // $packageCounts['total'] = $totalPkgCounts;

            if (!empty($packageCounts) && $totalPkgCounts <= $leadershipChampionsRank['directs']) {

                // Assign promotion only if not already present
                if (!in_array($promotion_pkg, $promotion_status_array, true)) 
                {
                    // / dd($promotion_pkg);
                    array_push($promotion_status_array, $promotion_pkg);

                    dd($promotion_status_array);

                    // $customer->promotion_status = $promotion_status_array;
                    // $customer->save();
                }

            }
            
        }

        //return $leadership;
        
    }

    public function assignPromotionFiveHundred($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        $customers = CustomersModel::where("app_id", $app->id)->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            $promotion_status_array = $customer->promotion_status;

            if (is_string($promotion_status_array)) {
                $promotion_status_array = json_decode($promotion_status_array, true);
            }

            // Still not array? Reset
            if (!is_array($promotion_status_array)) {
                $promotion_status_array = [];
            }

            $packageCounts = [];
            $activeDirectIds = [];
            $leadershipChampionsRank = [];

            if(!$customer->active_direct_ids)
            {
                continue;
            }
            
            $activeDirectIds    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
            
            // dd($activeDirectIds);

            if (empty($activeDirectIds)) {
                continue;
            }

            $leadershipChampionsRank = AppPromotionPackagesModel::where('app_id', $app->id)
                                                                            ->where('app_id', $customer->app_id)
                                                                            ->where('id', 2)
                                                                            ->first();
            $leadershipChampionsRankArray = json_decode($leadershipChampionsRank['package'], true);

            

            $allDirects = CustomerDepositsModel::select('*')
                                                    ->selectRaw('MIN(created_at) OVER (PARTITION BY customer_id, amount) as earliest_deposit_date')
                                                    ->whereIn('customer_id', $activeDirectIds)
                                                    ->where('payment_status', 'success')
                                                    ->where('is_free_deposit', 0)
                                                    ->whereIn('amount', $leadershipChampionsRankArray)
                                                    ->get();
            
            //Cast the amount to integer
            $allDirects = $allDirects->map(function ($row) {
                                            $row->amount = (int) $row->amount;
                                            return $row;
                                        });

            // count the pkg deposited 
            $packageCounts = $allDirects->groupBy('amount')
                                                ->map(fn ($rows) => $rows->groupBy('customer_id')->count());

            //calculate total and add 0 for the missing packages                                                
            $totalPkgCounts = 0;                                                
            foreach($leadershipChampionsRankArray as $pkg)
            {
                if (!$packageCounts->has($pkg)) 
                {
                    $packageCounts[$pkg] = 0;
                }

                $totalPkgCounts += $packageCounts[$pkg];
            }

            // $packageCounts['total'] = $totalPkgCounts;

            if (!empty($packageCounts) && $totalPkgCounts <= $leadershipChampionsRank['directs']) {

                // Ensure promotion_status is an array
                $promotion_status = $customer->promotion_status ?? [];
                if (!is_array($promotion_status)) 
                {
                    $promotion_status = (array) $promotion_status;
                }

                // Assign promotion only if not already present
                if (!in_array($promotion_pkg, $promotion_status, true)) 
                {
                    $promotion_status[] = $promotion_pkg;

                    $customer->promotion_status = $promotion_status;
                    $customer->save();
                }

            }
            
        }

        //return $leadership;
        
    }

    public function myPromotionStatus($customer, $promotionId)
    {

        $customer = CustomersModel::where("id", $customer->id)->where("app_id", $customer->app->id)->first();
    
        $packageCounts = [];
        $activeDirectIds = [];
        $leadershipChampionsRank = [];

        // dd($customer);
        
        if(!$customer->active_direct_ids)
        {
            return ["status_code"=>"error", message=>"No active directs"];
        }
            
        $activeDirectIds    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
            
        if (empty($activeDirectIds)) {
            return ["status_code"=>"error", message=>"No active directs"];
        }

        $leadershipChampionsRank = AppPromotionPackagesModel::where('app_id', $customer->app_id)
                                                                ->where('id', $promotionId)
                                                                ->first();

        $leadershipChampionsRankArray = $leadershipChampionsRank['package']; //json_decode($leadershipChampionsRank['package'], true);

        $allDirects = CustomerDepositsModel::select('*')
                                                ->selectRaw('MIN(created_at) OVER (PARTITION BY customer_id, amount) as earliest_deposit_date')
                                                ->whereIn('customer_id', $activeDirectIds)
                                                ->where('payment_status', 'success')
                                                ->where('is_free_deposit', 0)
                                                ->whereIn('amount', $leadershipChampionsRankArray)
                                                ->get();
        


        //Cast the amount to integer
        $allDirects = $allDirects->map(function ($row) {
                                        $row->amount = (int) $row->amount;
                                        return $row;
                                    });
        

        // dd($allDirects);  

        // count the pkg deposited 
        $packageCounts = $allDirects->groupBy('amount')
                                            ->map(fn ($rows) => $rows->groupBy('customer_id')->count());

        // dd($packageCounts);

        //calculate total and add 0 for the missing packages                                                
        $totalPkgCounts = 0;                                                
        foreach($leadershipChampionsRankArray as $pkg)
        {
            if (!$packageCounts->has($pkg)) 
            {
                $packageCounts[$pkg] = 0;
            }
        }

        // dd($packageCounts);

        return $packageCounts;
    }
}

