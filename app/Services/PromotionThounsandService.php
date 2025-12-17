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
    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    public function assignPromotionThousand()
    {       
        $app = AppsModel::find(1);

        $customers = CustomersModel::where("app_id", $app->id)->get();

        $leadership = [];

        // dd($customers);

        foreach($customers as $ckey => $customer)
        {

            // dd($customer);

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
            // dd($leadershipChampionsRank['package']);

            /*$allDirects = CustomerDepositsModel::whereIn('customer_id', $activeDirectIds)
                                                                ->where('payment_status', 'success') 
                                                                ->where('is_free_deposit', 0)
                                                                ->whereIn('amount',json_decode($leadershipChampionsRank['package'],true))
                                                                ->get();*/

            $allDirects = CustomerDepositsModel::select('*')
                                                    ->selectRaw('MIN(created_at) OVER (PARTITION BY customer_id, amount) as earliest_deposit_date')
                                                    ->whereIn('customer_id', $activeDirectIds)
                                                    ->where('payment_status', 'success')
                                                    ->where('is_free_deposit', 0)
                                                    ->whereIn('amount', json_decode($leadershipChampionsRank['package'], true))
                                                    ->get();

            foreach($allDirects as $direct)
            {
                
                $counts =   $allDirects->groupBy(['customer_id', 'amount'])
                                                ->map(fn ($group) => 1);

                dd($counts);                                
                
                // $directData = CustomersModel::find($direct->customer_id);
                                                
                // $diretDirectsCount    =   array_filter(explode('/', $directData->active_direct_ids ?? ''));


                // echo count($diretDirectsCount);
            }

            // dd("allDirects", $allDirects, "leadershipChampionsRank", $leadershipChampionsRank);
            
        }

        //return $leadership;
        
    }
}
