<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppsModel;
use App\Models\CustomersModel;
use App\Models\AppLeadershipChampionsIncomeModel;
use App\Models\CustomerDepositsModel;

use App\Traits\ManagesCustomerHierarchy;

class LeadershipChampionsIncomeService
{
    use ManagesCustomerHierarchy;

    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    public function assignLeadershipchampions()
    {       
        $app = AppsModel::find(1);

        $customers = CustomersModel::where("app_id", $app->id)->get();

        $leadership = [];
        foreach($customers as $ckey => $customer)
        {

            $activeDirectIds    =   array_filter(explode('/', $customer->active_direct_ids ?? ''));
            $allDirectIds       =   array_filter(explode('/', $customer->direct_ids ?? ''));

            if (empty($allDirectIds)) {
                continue;
            }

            $allTeamIds         = $this->getRecursiveTeamIds($customer->id);

            if (empty($allTeamIds)) {
                continue;
            }

            $totalTeamInvestment = CustomerDepositsModel::whereIn('customer_id', $allTeamIds)
                                        ->where('payment_status', 'success') 
                                        ->sum('amount');

            $leadershipChampionsRank = AppLeadershipChampionsIncomeModel::where('app_id', $app->id)
                                                                            ->where('team_volume', '<=', $totalTeamInvestment)
                                                                            ->where('directs', '<=', count($allDirectIds))
                                                                            ->orderBy('team_volume', 'desc')
                                                                            ->orderBy('directs', 'desc')
                                                                            ->first();
            if ($leadershipChampionsRank) {
                $customer->leadership_champions_rank = $leadershipChampionsRank->id; //rank;
                $customer->champions_point           = $leadershipChampionsRank->point;
                $customer->save();
                //$leadership[] = ["id"=>$customer->id, "rank"=>$leadershipChampionsRank->rank, "rank_id"=>$leadershipChampionsRank->id ];
            }
        }

        //return $leadership;
        
    }
}
