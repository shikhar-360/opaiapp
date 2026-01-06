<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\AppLevelPackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomerFlushDetailsModel;

use App\Traits\ManagesCustomerHierarchy;
use App\Traits\ManagesCustomerFinancials;
use App\Traits\DepositEligibilityTrait;

class LevelIncomeService
{

    use ManagesCustomerHierarchy;
    use ManagesCustomerFinancials;
    use DepositEligibilityTrait;

    /**
     * Calculate and record the Level Income for elligible customers on deposit.
     */
    public function releaseLevelIncome(CustomerDepositsModel $deposit)
    {       

        $customer = CustomersModel::with('referrals')->find($deposit->customer_id);

        if (!$customer) {
            return ['error' => 'Customer not found'];
        }

        $uplines = $this->getUplines($customer); 
        
        $levelConfigs = AppLevelPackagesModel::where('app_id', $deposit->app_id)
                                                ->orderBy('level')
                                                ->get()
                                                ->keyBy('level');

        $maxLevels = 20;
        $level = 1;
        $incomeDetails = [];
        $flushDetails = [];
        foreach ($uplines as $upline) 
        {

            if ($level > $maxLevels) 
            {
                break;
            }

            // Check eligibility
            if ($upline['actual_level'] >= $level) {

                $rewardPercent = (float) $levelConfigs[$level]->reward;
                $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;

                // Save income (DB insert recommended)
                $incomeDetails[] = [
                    'app_id'           => $deposit->app_id,
                    'customer_id'      => $upline['id'],  // upline user
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'amount_earned'    => $rewardAmount,
                    'earning_type'     => 'LEVEL-REWARD',
                    'reference_level'  => $level
                ];

                Log::info('Level income created ', [
                    'app_id'           => $deposit->app_id,
                    'customer_id'      => $upline['id'],  // upline user
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'amount_earned'    => $rewardAmount,
                    'earning_type'     => 'LEVEL-REWARD',
                    'reference_level'  => $level
                ]);

                $finance = $this->getCustomerFinance($upline['id'], $deposit->app_id);
                $finance->increment('total_income', $rewardAmount);
                $finance->save();
            }
            else
            {
                $flushDetails[] = [
                    'app_id'           => $deposit->app_id,
                    'upline_id'        => $upline['id'], // upline user
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'flush_amount'     => $rewardAmount,
                    'flush_level'      => $level,
                    'reason'           => 'NOT-ELIGIBLE'
                ];

                Log::info('Level flush created ', [
                    'app_id'           => $deposit->app_id,
                    'upline_id'        => $upline['id'],
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'flush_amount'     => $rewardAmount,
                    'flush_level'      => $upline_level,
                    'reason'           => 'NOT-ELIGIBLE'
                ]);
            }

            $level++;
        }

        // Save income to DB
        DB::transaction(function () use ($incomeDetails, $flushDetails) {
            foreach ($incomeDetails as $record) {
                CustomerEarningDetailsModel::create($record);
            }
            foreach ($flushDetails as $flush) {
                CustomerFlushDetailsModel::create($flush);
            }
        });

        return [
            'status'        => 'success',
            'income_count'  => count($incomeDetails),
            'income'       => $incomeDetails,
            'flush'       => $flushDetails
        ];
    }

}
