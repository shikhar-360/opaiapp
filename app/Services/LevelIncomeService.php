<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppLevelPackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerEarningDetailsModel;

use App\Traits\ManagesCustomerHierarchy;
use App\Traits\ManagesCustomerFinancials;

class LevelIncomeService
{

    use ManagesCustomerHierarchy;
    use ManagesCustomerFinancials;

    /**
     * Calculate and record the ROI on ROI for elligible customers.
     */
    public function releaseLevelIncome(CustomerDepositsModel $deposit)
    {       

        $customer = CustomersModel::with('referrals')->find($deposit->customer_id);

        if (!$customer) {
            return ['error' => 'Customer not found'];
        }

        // Get all uplines
        $customerUplines = $this->getUplines($customer);

        // Get all level packages for the app
        $levelPackages = AppLevelPackagesModel::where('app_id', $deposit->app_id)
                                                ->orderBy('level', 'ASC')
                                                ->get()
                                                ->keyBy('level');   // Faster lookup

        $incomeDetails = [];
        
        foreach ($customerUplines as $upline) {

            $level = $upline['level'];

            // Skip if package for this level does not exist
            if (!isset($levelPackages[$level])) {
                continue;
            }

            $pkg = $levelPackages[$level];

            // Check if upline qualifies (directs >= required)
            if ($upline['directs'] >= $pkg->directs) {

                $rewardAmount = $deposit->amount * ($pkg->reward / 100);
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $incomeDetails[] = [
                    'app_id'           => $deposit->app_id,
                    'customer_id'      => $upline['id'],  // upline user
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'amount_earned'    => $rewardAmount,
                    'earning_type'     => 'LEVEL-REWARD',
                ];

                $finance = $this->getCustomerFinance($upline['id'], $deposit->app_id);
                $finance->increment('total_income', $rewardAmount);
                // $finance->decrement('total_topup', $deposit->amount); 
                $finance->save();
            }
        }

        // Save income to DB
        DB::transaction(function () use ($incomeDetails) {
            foreach ($incomeDetails as $record) {
                CustomerEarningDetailsModel::create($record);
            }
        });

        return [
            'status'        => 'success',
            'income_count'  => count($incomeDetails),
            'records'       => $incomeDetails
        ];
        
    }
}
