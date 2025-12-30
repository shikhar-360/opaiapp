<?php
// App/Services/LevelIncomeService.php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\AppLevelPackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomerFlushDetailsModel;

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
        // dd($customerUplines);
        // Get all level packages for the app
        $levelPackages = AppLevelPackagesModel::where('app_id', $deposit->app_id)
                                                ->orderBy('level', 'ASC')
                                                ->get()
                                                ->keyBy('level');   // Faster lookup
        // dd($customerUplines, $levelPackages);
        $incomeDetails = [];
        
        $totalFlushAmount = 0;
        $totalEarnedAmount = 0;
        $flushDetails = [];

        foreach ($customerUplines as $upline) {

            $upline_level = $upline['level'];
            $opened_level = $upline['level_id']; //from DB

            $actualDepositCounts      =   CustomerDepositsModel::where('customer_id', $upline['id'])
                                                                        ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
                                                                        ->where('is_free_deposit', 0)
                                                                        ->count();
            // Skip if package for this level does not exist
            if (!isset($levelPackages[$upline_level])) {
                continue;
            }

            // If do not have actual deposit then level income from 1st 
            $pkg = $levelPackages[1];
            if($actualDepositCounts > 0)
            {
                $pkg = $levelPackages[$upline_level];
            }

            $rewardAmount = $deposit->amount * ($pkg->reward / 100);

            
            // if (($upline_level <= $opened_level) && ($upline['directs'] >= $pkg->directs)) {

            if ($upline['directs'] >= $pkg->directs) {

                $totalEarnedAmount += $rewardAmount;
                
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                $incomeDetails[] = [
                    'app_id'           => $deposit->app_id,
                    'customer_id'      => $upline['id'],  // upline user
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'amount_earned'    => $rewardAmount,
                    'earning_type'     => 'LEVEL-REWARD',
                    'reference_level'  => $upline_level
                ];

                // Update level only on new user registration
                /*$uplineCustomer = CustomersModel::find($upline['id']);
                if ($uplineCustomer && $uplineCustomer->level_id < $level) {
                    $uplineCustomer->level_id = $level;
                    $uplineCustomer->save();
                }*/
                

                $finance = $this->getCustomerFinance($upline['id'], $deposit->app_id);
                $finance->increment('total_income', $rewardAmount);
                // $finance->decrement('total_topup', $deposit->amount); 
                $finance->save();
            }
            else
            {
                
                $totalFlushAmount += $rewardAmount;
                
                $flushDetails[] = [
                    'app_id'           => $deposit->app_id,
                    'upline_id'        => $upline['id'],
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'flush_amount'     => $rewardAmount,
                    'flush_level'      => $upline_level,
                    'reason'           => 'NOT-ELIGIBLE'
                ];
            }

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
            'records'       => $incomeDetails
        ];
        
    }
}
