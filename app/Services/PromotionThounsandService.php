<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\AppsModel;
use App\Models\CustomersModel;
use App\Models\AppPromotionPackagesModel;
use App\Models\CustomerDepositsModel;

class PromotionThounsandService
{
    
    public function assignPromotionThousand($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        // $customers = CustomersModel::where("app_id", $app->id)->get();

        $count = CustomersModel::where("app_id", $app->id)
                                    ->whereRaw(
                                        'FIND_IN_SET(?, promotion_status)',
                                        [1]
                                    )->count();

        if($count >= 1000)
        {
            return "Can not proceed, reached the promotion max i.e. 1000";
        }

        $customers = CustomersModel::where("app_id", $app->id)
                        ->whereNotNull('active_direct_ids')
                        ->where(function ($q) {
                            $q->whereNull('promotion_status')
                              ->orWhere('promotion_status', '')
                              ->orWhereRaw('NOT FIND_IN_SET(?, promotion_status)', [1]);
                        })
                        ->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            if($count <= 1000)
            {
                $promotion_status_array = [];

                if (!empty($customer->promotion_status)) {
                    $promotion_status_array = array_map(
                        'intval',
                        array_filter(explode(',', $customer->promotion_status))
                    );
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
                                                                                ->where('id', $promotion_pkg)
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

                // dd($packageCounts);

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


                if (!empty($packageCounts) && $totalPkgCounts >= $leadershipChampionsRank['directs']) {

                    // $promotion_status_array = array_map('intval', $promotion_status_array);
                    
                    // dd(gettype($promotion_pkg), array_map('gettype', $promotion_status_array));
                    // dd($totalPkgCounts, $promotion_pkg, $promotion_status_array);

                    // Assign promotion only if not already present
                    if (!in_array((int)$promotion_pkg, $promotion_status_array, true)) 
                    {
                        // / dd($promotion_pkg);
                        array_push($promotion_status_array, (int)$promotion_pkg);
                        $customer->promotion_status = implode(',', array_unique($promotion_status_array));
                        $customer->save();

                        $transactionString = Str::random(5);

                        CustomerDepositsModel::insert([
                            [
                                'app_id'           => $customer->app_id,
                                'customer_id'      => $customer->id,
                                'package_id'       => 1,
                                'amount'           => 5,
                                'roi_percent'      => 0,
                                'roi_earned'       => 0,
                                'transaction_id'   => 'PROMOTION10K-5-'.$transactionString,
                                'payment_status'   => 'success', // or 1
                                'coin_price'       => 0,
                                'is_free_deposit'  => 0,
                            ],
                            [
                                'app_id'           => $customer->app_id,
                                'customer_id'      => $customer->id,
                                'package_id'       => 2,
                                'amount'           => 10,
                                'roi_percent'      => 0,
                                'roi_earned'       => 0,
                                'transaction_id'   => 'PROMOTION10K-10-'.$transactionString,
                                'payment_status'   => 'success', // or 1
                                'coin_price'       => 0,
                                'is_free_deposit'  => 0,
                            ]
                        ]);

                        $count++;

                    }

                }

            }
            
        }

        //return $leadership;
        
    }

    public function assignPromotionFiveHundred($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        $count = CustomersModel::where("app_id", $app->id)
                                    ->whereRaw(
                                        'FIND_IN_SET(?, promotion_status)',
                                        [2]
                                    )->count();

        if($count >= 1000)
        {
            return "Can not proceed, reached the promotion max i.e. 1000";
        }

        // $customers = CustomersModel::where("app_id", $app->id)->get();
        $customers = CustomersModel::where("app_id", $app->id)
                        ->whereNotNull('active_direct_ids')
                        ->where(function ($q) {
                            $q->whereNull('promotion_status')
                              ->orWhere('promotion_status', '')
                              ->orWhereRaw('NOT FIND_IN_SET(?, promotion_status)', [2]);
                        })
                        ->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            if($count <= 1000)
            {
                $promotion_status_array = [];

                if (!empty($customer->promotion_status)) {
                    $promotion_status_array = array_map(
                        'intval',
                        array_filter(explode(',', $customer->promotion_status))
                    );
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
                                                                                ->where('id', $promotion_pkg)
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

                // dd($packageCounts);

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


                if (!empty($packageCounts) && $totalPkgCounts >= $leadershipChampionsRank['directs']) 
                {

                    // $promotion_status_array = array_map('intval', $promotion_status_array);
                    
                    // dd(gettype($promotion_pkg), array_map('gettype', $promotion_status_array));
                    // dd($totalPkgCounts, $promotion_pkg, $promotion_status_array);

                    // Assign promotion only if not already present
                    if (!in_array((int)$promotion_pkg, $promotion_status_array, true)) 
                    {
                        // / dd($promotion_pkg);
                        array_push($promotion_status_array, (int)$promotion_pkg);
                        $customer->promotion_status = implode(',', array_unique($promotion_status_array));
                        $customer->save();

                        $transactionString = Str::random(5);

                        CustomerDepositsModel::insert([
                            [
                                'app_id'           => $customer->app_id,
                                'customer_id'      => $customer->id,
                                'package_id'       => 3,
                                'amount'           => 25,
                                'roi_percent'      => 0,
                                'roi_earned'       => 0,
                                'transaction_id'   => 'PROMOTION500-25-'.$transactionString,
                                'payment_status'   => 'success', // or 1
                                'coin_price'       => 0,
                                'is_free_deposit'  => 0,
                            ],
                            [
                                'app_id'           => $customer->app_id,
                                'customer_id'      => $customer->id,
                                'package_id'       => 4,
                                'amount'           => 50,
                                'roi_percent'      => 0,
                                'roi_earned'       => 0,
                                'transaction_id'   => 'PROMOTION500-50-'.$transactionString,
                                'payment_status'   => 'success', // or 1
                                'coin_price'       => 0,
                                'is_free_deposit'  => 0,
                            ]
                        ]);

                        $count++;
                    }

                }

            }
            
        }

        //return $leadership;
        
    }


    public function assignPromotionTenX($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        $count = CustomersModel::where("app_id", $app->id)
                                    ->whereRaw(
                                        'FIND_IN_SET(?, promotion_status)',
                                        [3]
                                    )->count();

        if($count >= 1000)
        {
            return "Can not proceed, reached the promotion max i.e. 1000";
        }

        // $customers = CustomersModel::where("app_id", $app->id)->get();

        $customers = CustomersModel::where("app_id", $app->id)
                        ->whereNotNull('active_direct_ids')
                        ->where(function ($q) {
                            $q->whereNull('promotion_status')
                              ->orWhere('promotion_status', '')
                              ->orWhereRaw('NOT FIND_IN_SET(?, promotion_status)', [3]);
                        })
                        ->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            if($count <= 1000)
            {

                $promotion_status_array = [];

                if (!empty($customer->promotion_status)) {
                    $promotion_status_array = array_map(
                        'intval',
                        array_filter(explode(',', $customer->promotion_status))
                    );
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
                                                                                ->where('id', $promotion_pkg)
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

                // dd($packageCounts);

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


                if (!empty($packageCounts) && $totalPkgCounts >= $leadershipChampionsRank['directs']) {

                    // $promotion_status_array = array_map('intval', $promotion_status_array);
                    
                    // dd(gettype($promotion_pkg), array_map('gettype', $promotion_status_array));
                    // dd($totalPkgCounts, $promotion_pkg, $promotion_status_array);

                    // Assign promotion only if not already present
                    if (!in_array((int)$promotion_pkg, $promotion_status_array, true)) 
                    {
                        // / dd($promotion_pkg);
                        array_push($promotion_status_array, (int)$promotion_pkg);
                        $customer->promotion_status = implode(',', array_unique($promotion_status_array));
                        $customer->save();

                        // CustomerDepositsModel::create([
                        //     'app_id'           => $customer->app_id,
                        //     'customer_id'      => $customer->id,
                        //     'package_id'       => 3,
                        //     'amount'           => 25,
                        //     'roi_percent'      => 0,
                        //     'roi_earned'       => 0,
                        //     'transaction_id'   => 'PROMOTION10X-25',
                        //     'payment_status'   => 'success', // or 1
                        //     'coin_price'       => 0,
                        //     'is_free_deposit'  => 0,
                        // ]);

                        // CustomerDepositsModel::create([
                        //     'app_id'           => $customer->app_id,
                        //     'customer_id'      => $customer->id,
                        //     'package_id'       => 4,
                        //     'amount'           => 50,
                        //     'roi_percent'      => 0,
                        //     'roi_earned'       => 0,
                        //     'transaction_id'   => 'PROMOTION10X-50',
                        //     'payment_status'   => 'success', // or 1
                        //     'coin_price'       => 0,
                        //     'is_free_deposit'  => 0,
                        // ]);

                        $count++;
                    }

                }
            }
            
        }

        //return $leadership;
        
    }

    public function assignPromotionFiveThousand($promotion_pkg)
    {       
        
        $app = AppsModel::find(1);

        $count = CustomersModel::where("app_id", $app->id)
                                    ->whereRaw(
                                        'FIND_IN_SET(?, promotion_status)',
                                        [4]
                                    )->count();

        if($count >= 5000)
        {
            return "Can not proceed, reached the promotion max i.e. 5000";
        }

        // $customers = CustomersModel::where("app_id", $app->id)->get();

        $customers = CustomersModel::where("app_id", $app->id)
                        ->whereNotNull('active_direct_ids')
                        ->where(function ($q) {
                            $q->whereNull('promotion_status')
                              ->orWhere('promotion_status', '')
                              ->orWhereRaw('NOT FIND_IN_SET(?, promotion_status)', [4]);
                        })
                        ->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            if($count <= 5000)
            {

                $promotion_status_array = [];

                if (!empty($customer->promotion_status)) {
                    $promotion_status_array = array_map(
                        'intval',
                        array_filter(explode(',', $customer->promotion_status))
                    );
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
                                                                                ->where('id', $promotion_pkg)
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

                // dd($packageCounts);

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


                if (!empty($packageCounts) && $totalPkgCounts >= $leadershipChampionsRank['directs']) {

                    // $promotion_status_array = array_map('intval', $promotion_status_array);
                    
                    // dd(gettype($promotion_pkg), array_map('gettype', $promotion_status_array));
                    // dd($totalPkgCounts, $promotion_pkg, $promotion_status_array);

                    // Assign promotion only if not already present
                    if (!in_array((int)$promotion_pkg, $promotion_status_array, true)) 
                    {
                        // / dd($promotion_pkg);
                        array_push($promotion_status_array, (int)$promotion_pkg);
                        $customer->promotion_status = implode(',', array_unique($promotion_status_array));
                        $customer->save();

                        $transactionString = Str::random(5);

                        CustomerDepositsModel::create([
                            'app_id'           => $customer->app_id,
                            'customer_id'      => $customer->id,
                            'package_id'       => 3,
                            'amount'           => 25,
                            'roi_percent'      => 0,
                            'roi_earned'       => 0,
                            'transaction_id'   => 'PROMOTION5K-25-'.$transactionString,
                            'payment_status'   => 'success', // or 1
                            'coin_price'       => 0,
                            'is_free_deposit'  => 0,
                        ]);

                        $count++;

                    }

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
            return ["0"=>"0","1"=>"0"];
        }
            
        $activeDirectIds    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
            
        if (empty($activeDirectIds)) {
            return ["0"=>"0","1"=>"0"];
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

        $beneficiaryCount = CustomersModel::where("app_id", $customer->app->id)
                                    ->whereRaw(
                                        'FIND_IN_SET(?, promotion_status)',
                                        [1]
                                    )->count();
                                    
        // dd([$packageCounts, $beneficiaryCount]);

        return [$packageCounts, $beneficiaryCount];
    }
}

