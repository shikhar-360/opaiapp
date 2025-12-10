<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppLevelPackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerEarningDetailsModel;

class LevelIncomeService
{
    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    public function releaseLevelIncome(CustomersModel $sponsor, CustomerDepositsModel $deposit)
    {       
        $activedirects = explode("/",$sponsor->active_direct_ids);
        $activeDirectsCount = count($activedirects);
        if (empty($activeDirectsCount)) {
            return response()->json([
                        'sponsor_id' => $sponsor->id,
                        'message' => "No active directs"
            ]);
        }

        $levelPackages = AppLevelPackagesModel::where('app_id', $sponsor->app_id)
                                                ->orderBy('directs', 'DESC')
                                                ->get(); 
        if (!$levelPackages) {
            return response()->json([
                        'sponsor_id' => $sponsor->id,
                        'message' => "No level package"
            ]);
        }
        
        $qualifiedLevelId = null;
        $qualifiedLevelReward = 0;
        foreach ($levelPackages as $levelPackage) {
            // Check if the user's actual count meets or exceeds the requirement for this level
            if ($activeDirectsCount >= (int)$levelPackage->directs) {
                // This is the highest level they qualify for
                $qualifiedLevelId = $levelPackage->id;
                $qualifiedLevelReward = $levelPackage->reward;
                // If this level is higher than their current one, update them
                // if ($qualifiedLevelId > $customer->level_id) {
                // }
                break; 
            }
        }
        $rewardAmount = 0;
        if($qualifiedLevelReward > 0)
        {
            $rewardAmount = $deposit->amount * ($qualifiedLevelReward / 100 );
        }

        
        DB::transaction(function () use ($deposit, $sponsor, $qualifiedLevelId, $rewardAmount) {
            
            CustomerEarningDetailsModel::create([
                'app_id'             => $sponsor->app_id,
                'customer_id'        => $sponsor->id, 
                'reference_id'       => $qualifiedLevelId,
                'reference_amount'   => $deposit->amount,
                'amount_earned'      => $rewardAmount,
                'earning_type'       => 'LEVEL-REWARD', 
            ]);

            $sponsor->level_id = $qualifiedLevelId;
            $sponsor->save();
            
        });
        
    }

    private function getRecursiveTeamIds(int $customerId): array
    {
        $teamIds = [];
        $directReferrals = CustomersModel::where('sponsor_id', $customerId)->pluck('id');

        if ($directReferrals->isEmpty()) {
            return [];
        }

        foreach ($directReferrals as $referralId) {
            $teamIds[] = $referralId;
            // Merge the IDs from the next level down recursively
            $teamIds = array_merge($teamIds, $this->getRecursiveTeamIds($referralId));
        }

        return array_unique($teamIds);
    }
}
