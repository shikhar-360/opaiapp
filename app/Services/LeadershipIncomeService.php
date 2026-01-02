<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppsModel;
use App\Models\CustomersModel;
use App\Models\AppLeadershipIncomeModel;
use App\Models\CustomerDepositsModel;

use App\Traits\ManagesCustomerHierarchy;

class LeadershipIncomeService
{
    use ManagesCustomerHierarchy;

    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    public function assignLeadership()
    {       
        $app = AppsModel::find(1);

        $customers = CustomersModel::where("app_id", $app->id)->get();

        $leadership = [];
        foreach($customers as $ckey => $customer)
        {
            $allTeamIds = $this->getRecursiveTeamIds($customer->id);

            $totalTeamInvestment = CustomerDepositsModel::whereIn('customer_id', $allTeamIds)
                                        ->where('payment_status', 'success') 
                                        ->where('is_free_deposit', 0)
                                        ->sum('amount');

            $leadershipRank = AppLeadershipIncomeModel::where('app_id', $app->id)
                                                            ->where('team_volume', '<=', $totalTeamInvestment)
                                                            ->orderBy('team_volume', 'desc')
                                                            ->first();
            // if ($leadershipRank) {
            //     $customer->leadership_rank = $leadershipRank->id; 
            //     $customer->leadership_points = $leadershipRank->points; 
            //     $customer->save();
            //     //$leadership[] = ["id"=>$customer->id, "rank"=>$leadershipRank->rank, "rank_id"=>$leadershipRank->id, "rank_points"=>$leadershipRank->points ];
            // }

            if ($leadershipRank) {
                $customer->leadership_rank = $leadershipRank->id; 
                $customer->leadership_points    = ($customer->leadership_points ?? 0) + ($leadershipRank->points ?? 0);
                $customer->save();
            }
        }

        //return $leadership;
        
    }
}
