<?php
// App/Services/RoiOnRoiDistributionService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppLevelPackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerEarningDetailsModel;

class RoiOnRoiDistributionService
{
    /**
     * Calculate and distribute ROI for all eligible deposits for today.
     */
    public function distributeRoiOnRoi($app_id)
    {
        // Get all active deposits where the activation date is today or earlier
        $eligibleCustomers = CustomerDepositsModel::select('customer_deposits.*','customers.level_id')
                                                    ->join('customers', 'customer_deposits.customer_id', '=', 'customers.id')
                                                    ->where('customers.level_id', '>', 0)
                                                    ->where('customers.app_id', $app_id) 
                                                    ->distinct() 
                                                    ->get();
        foreach ($eligibleCustomers as $customer) {
            $this->processCustomerRoiOnRoi($customer);
        }
    }

    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    protected function processCustomerRoiOnRoi(CustomerDepositsModel $deposit)
    {
        $teamIds = $this->getRecursiveTeamIds($deposit->customer_id);
        if (empty($teamIds)) {
            return response()->json([
                        'customer_id' => $deposit->customer_id,
                        'message' => "No team members"
            ]);
        }

        $totalTeamRoi = CustomerDepositsModel::whereIn('customer_id', $teamIds)
                                                ->where('roi_earned', '>', 0)
                                                // Add date constraints if necessary: ->whereDate('created_at', today())
                                                ->sum('roi_earned');
        if ($totalTeamRoi <= 0) {
            return response()->json([
                        'customer_id' => $deposit->customer_id,
                        'message' => "No earned ROI"
            ]);
        }

        $levelPackage = AppLevelPackagesModel::where('id',$deposit->level_id)
                                                    ->where('app_id',$deposit->app_id)
                                                    ->first(); 
        if (!$levelPackage) {
            return response()->json([
                        'customer_id' => $deposit->customer_id,
                        'message' => "No level package"
            ]);
        }
        
        $rewardPercentage = $levelPackage->reward;
    
        $rewardAmount = $totalTeamRoi * ($rewardPercentage / 100 );

        DB::transaction(function () use ($deposit, $totalTeamRoi, $rewardAmount, $levelPackage) {
            
            CustomerEarningDetailsModel::create([
                'app_id'             => $deposit->app_id,
                'customer_id'        => $deposit->customer_id, 
                'reference_id'       => $levelPackage->id,
                'reference_amount'   => $totalTeamRoi,
                'amount_earned'      => $rewardAmount,
                'earning_type'       => 'ROI-ON-ROI', 
            ]);

            // $deposit->increment('roi_earned', $dailyROIAmount);
            // 2. Optionally, credit the amount to the user's main balance (requires a User balance column/ledger system)
            // $deposit->user->increment('balance', $amountToDistribute);
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
