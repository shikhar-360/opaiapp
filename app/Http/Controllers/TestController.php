<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\PromotionThounsandService;
use App\Services\LevelIncomeService;
use App\Models\CustomerEarningDetailsModel;
use App\Models\CustomersModel;
use App\Models\AppLevelPackagesModel;

use App\Traits\ManagesCustomerHierarchy;
use App\Traits\ManagesCustomerFinancials;
use App\Traits\DepositEligibilityTrait;


class TestController extends Controller
{
    protected $pk;
    protected $lis;

    use ManagesCustomerHierarchy;
    use ManagesCustomerFinancials;
    use DepositEligibilityTrait;

    public function __construct(PromotionThounsandService $p1000, LevelIncomeService $liss)
    {
        $this->pk = $p1000;
        $this->lis = $liss;
    }

    public function testPromotionThounsand(Request $request)
    {
        // $this->pk->assignPromotionThousand($promotion_pkg=1);
        // $this->pk->assignPromotionFiveHundred($promotion_pkg=2);
        // $this->pk->assignPromotionTenX($promotion_pkg=3);
        // $this->pk->assignPromotionFiveThousand($promotion_pkg=4);
    }

    public function testLevelIncome(Request $request)
    {
        $deposit = [
            'app_id'        => 1,
            'customer_id'   => 13,
            'package_id'    => 2,
            'amount'        => 10,
            'roi_percent'   => 0,
            'transaction_id'=> 'abcd123',
            'payment_status'=> 'pending',
            'coin_price'    => 2
        ];

        $lis_res = $this->lis->generateLevelIncome($deposit);

        dd($lis_res);
    }


    public function releaseLevelIncomeTest_STOP()
    {       
        $deposit = (object)["customer_id"=>233, "app_id"=>1,  "amount"=>25];

        $customer = CustomersModel::with('referrals')->find($deposit->customer_id);

        if (!$customer) {
            return ['error' => 'Customer not found'];
        }

        $uplines = $this->getUplines($customer); 


          //       0 => array:7 [▼
          //   "id" => 2
          //   "name" => "BlackShark"
          //   "level" => 1
          //   "directs" => 1
          //   "active_directs" => 1
          //   "level_id" => 2
          //   "actual_level" => 2
          // ]
          // 1 => array:7 [▼
          //   "id" => 1
          //   "name" => "admin"
          //   "level" => 2
          //   "directs" => 20
          //   "active_directs" => 1
          //   "level_id" => 20
          //   "actual_level" => 20
          // ]


        $levelConfigs = AppLevelPackagesModel::where('app_id', $deposit->app_id)
                                                ->orderBy('level')
                                                ->get()
                                                ->keyBy('level');

        // 1[▼
        //         "id" => 1
        //         "app_id" => 1
        //         "level" => 1
        //         "directs" => 0
        //         "reward" => "20.00"
        //         "created_at" => "2025-12-02 23:23:04"
        //         "updated_at" => "2026-01-06 09:52:18"
        //       ]
        // 2[▼
        //         "id" => 2
        //         "app_id" => 1
        //         "level" => 2
        //         "directs" => 1
        //         "reward" => "10.00"
        //         "created_at" => "2025-12-02 23:23:04"
        //         "updated_at" => "2025-12-02 23:23:04"
        //       ]


        Log::info('GET levelConfigs', [$levelConfigs]);
        
        $maxLevels = 20;
        $level = 1;
        $incomeDetails = [];
        $flushDetails = [];

        Log::info('GET uplines', [$uplines]);

        foreach ($uplines as $upline) 
        {

            if ($level > $maxLevels) 
            {
                break;
            }
            
            $finance_upline    = $this->getCustomerFinance($upline['id'], $deposit->app_id);
            $upline_fin_cap    = (float) $finance_upline->capping_limit;
            $upline_fin_income = (float) $finance_upline->total_income;

            Log::info('GET upline_fin_cap, upline_fin_income', [$upline_fin_cap, $upline_fin_income]);

            // Default values
            $amountEarned = 0;
            $flushAmount  = 0;

            // Eligibility check
            Log::info('CHECK upline[actual_level] >= level', [$upline['actual_level'], $level]);

            if ($upline['actual_level'] >= $level) 
            {

                // Level Eligibility check start
                
                $rewardPercent = (float) $levelConfigs[$level]->reward;

                Log::info('GET rewardPercent:', [$rewardPercent]);

                $hasFreeDepositOnly = false;
                $hasNoAnyDeposit = false;

                if($upline['id']>1)
                {
                    if($this->hasAnyDeposit($upline['id']))
                    {
                        if($this->hasOnlyFreeDeposit($upline['id']))
                        {
                            $rewardPercent = (float) $levelConfigs[1]->reward;
                            $hasFreeDepositOnly = true;
                        }
                    }
                    else
                    {
                        $rewardPercent = (float) $levelConfigs[1]->reward;
                        $hasNoAnyDeposit = true;
                    }
                }   
                // Level Eligibility check end

                // $rewardPercent = (float) $levelConfigs[$level]->reward;

                Log::info('GET hasFreeDepositOnly, hasNoAnyDeposit:', [$hasFreeDepositOnly, $hasNoAnyDeposit]);

                $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;

                Log::info('GET rewardAmount:', [$rewardAmount]);
                
                if($upline['id']>1)
                {
                    if($hasFreeDepositOnly)
                    {
                        $amountEarned = $rewardAmount;
                        $flushAmount  = 0;
                        Log::info('GET1 rewardPercent, rewardAmount, amountEarned, flushAmount', [$rewardPercent, $rewardAmount, $amountEarned, $flushAmount]);
                    }
                    else
                    {   
                        // CAPING
                        if (($upline_fin_income + $rewardAmount) > $upline_fin_cap) 
                        {
                            $amountEarned = max(0, $upline_fin_cap - $upline_fin_income);
                            $flushAmount  = ($upline_fin_income + $rewardAmount) - $upline_fin_cap;
                            
                            Log::info('GET2 rewardPercent, rewardAmount, amountEarned, flushAmount', [$rewardPercent, $rewardAmount, $amountEarned, $flushAmount]);

                        } 
                        else 
                        {
                            $amountEarned = $rewardAmount;
                            $flushAmount  = 0;
                            Log::info('GET3 rewardPercent, rewardAmount, amountEarned, flushAmount', [$rewardPercent, $rewardAmount, $amountEarned, $flushAmount]);                    
                        }
                    }
                }
                else
                {
                    $amountEarned = $rewardAmount;
                    $flushAmount  = 0;
                    Log::info('GET4 rewardPercent, rewardAmount, amountEarned, flushAmount', [$rewardPercent, $rewardAmount, $amountEarned, $flushAmount]);
                }
            } 
            else 
            {
                // Not eligible → full flush
                $rewardPercent = (float) $levelConfigs[$level]->reward;
                $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;

                $amountEarned = 0;
                $flushAmount  = $rewardAmount;

                Log::info('GET5 rewardPercent, rewardAmount, amountEarned, flushAmount', [$rewardPercent, $rewardAmount, $amountEarned, $flushAmount]);
            }

            // Prepare record
            $incomeDetails[] = [
                'app_id'           => $customer->app_id,
                'customer_id'      => $upline['id'],
                'reference_id'     => $customer->id,
                'reference_amount' => $deposit->amount,
                'amount_earned'    => $amountEarned,
                'flush_amount'     => $flushAmount,
                'earning_type'     => $amountEarned > 0 ? CustomerEarningDetailsModel::EARNING_TYPE_REWARD : CustomerEarningDetailsModel::EARNING_TYPE_FLUSH,
                'reference_level'  => $level
            ];

            $level++;
        }

        // Save income to DB

        dd([
            'status'        => 'success',
            'income_count'  => count($incomeDetails),
            'deposit'       => $deposit,
            'income'        => $incomeDetails,
        ]);
    }

    public function releaseLevelIncomeTest()
    {       
        $deposit = (object)["customer_id"=>233, "app_id"=>1,  "amount"=>25];

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
            
            $finance_upline    = $this->getCustomerFinance($upline['id'], $deposit->app_id);
            $upline_fin_cap    = (float) $finance_upline->capping_limit;
            $upline_fin_income = (float) $finance_upline->total_income;

            // Default values
            $amountEarned = 0;
            $flushAmount  = 0;

            // Eligibility check
            if ($upline['level'] >= $level) 
            {

                if($this->hasOnlyFreeDeposit($upline['id']))
                {
                    if($upline['level'] == 1)
                    {
                        $rewardPercent = (float) $levelConfigs[1]->reward;
                        $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;
                        $flushAmount  = 0;
                        $amountEarned = $rewardAmount;
                    }
                    else
                    {
                        if($upline['id']>1)
                        {
                            $rewardPercent = (float) $levelConfigs[$level]->reward;
                            $rewardAmount  = 0;
                            $flushAmount  = ($deposit->amount * $rewardPercent) / 100;
                            $amountEarned = $rewardAmount;
                        }
                        else
                        {
                            $rewardPercent = (float) $levelConfigs[$level]->reward;
                            $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;
                            $flushAmount  = 0;
                            $amountEarned = $rewardAmount;
                        }
                    }



                    $incomeDetails[] = [
                        'type'             => 'FREE',
                        'app_id'           => $customer->app_id,
                        'customer_id'      => $upline['id'],
                        'reference_id'     => $customer->id,
                        'reference_amount' => $deposit->amount,
                        'amount_earned'    => $amountEarned,
                        'flush_amount'     => $flushAmount,
                        'earning_type'     => $amountEarned > 0 ? CustomerEarningDetailsModel::EARNING_TYPE_REWARD : CustomerEarningDetailsModel::EARNING_TYPE_FLUSH,
                        'reference_level'  => $level
                    ];
                }
                else if($this->hasAnyDeposit($upline['id']) && ($upline['level'] >= $level))
                {
                    $rewardPercent = (float) $levelConfigs[$level]->reward;

                    $rewardAmount  = ($deposit->amount * $rewardPercent) / 100;

                    if($upline_fin_cap > ($upline_fin_income + $rewardAmount))
                    {
                        $amountEarned = $rewardAmount;
                        $flushAmount = 0;
                        echo "here 1";
                    }
                    else 
                    {
                        // $amountEarned = max(0, $upline_fin_cap - $upline_fin_income);
                        // $flushAmount  = ($upline_fin_income + $rewardAmount) - $upline_fin_cap;   

                        $remainingCap = max(0, $upline_fin_cap - $upline_fin_income);
                        $amountEarned = $remainingCap;
                        $flushAmount  = max(0, $rewardAmount - $remainingCap);  
                        echo "here 2";
                    } 

                    $incomeDetails[] = [
                        'type'             => 'PAID',
                        'app_id'           => $customer->app_id,
                        'customer_id'      => $upline['id'],
                        'reference_id'     => $customer->id,
                        'reference_amount' => $deposit->amount,
                        'amount_earned'    => $amountEarned,
                        'flush_amount'     => $flushAmount,
                        'earning_type'     => $amountEarned > 0 ? CustomerEarningDetailsModel::EARNING_TYPE_REWARD : CustomerEarningDetailsModel::EARNING_TYPE_FLUSH,
                        'reference_level'  => $level
                    ];
                }
                else
                {
                    $rewardPercent = (float) $levelConfigs[$level]->reward;
                    $flushAmount  = ($deposit->amount * $rewardPercent) / 100;

                    $incomeDetails[] = [
                        'type'             => 'NODEPOST',
                        'app_id'           => $customer->app_id,
                        'customer_id'      => $upline['id'],
                        'reference_id'     => $customer->id,
                        'reference_amount' => $deposit->amount,
                        'amount_earned'    => $amountEarned,
                        'flush_amount'     => $flushAmount,
                        'earning_type'     => $amountEarned > 0 ? CustomerEarningDetailsModel::EARNING_TYPE_REWARD : CustomerEarningDetailsModel::EARNING_TYPE_FLUSH,
                        'reference_level'  => $level
                    ];
                }
            }
            else
            {
                $rewardPercent = (float) $levelConfigs[$level]->reward;
                $flushAmount  = ($deposit->amount * $rewardPercent) / 100;

                $incomeDetails[] = [
                    'type'             => 'BELOWLEVEL',
                    'app_id'           => $customer->app_id,
                    'customer_id'      => $upline['id'],
                    'reference_id'     => $customer->id,
                    'reference_amount' => $deposit->amount,
                    'amount_earned'    => $amountEarned,
                    'flush_amount'     => $flushAmount,
                    'earning_type'     => $amountEarned > 0 ? CustomerEarningDetailsModel::EARNING_TYPE_REWARD : CustomerEarningDetailsModel::EARNING_TYPE_FLUSH,
                    'reference_level'  => $level
                ];
            }
            $level++;
        }

        // Save income to DB
     
        dd([
            'status'        => 'success',
            'income_count'  => count($incomeDetails),
            'deposit'       => $deposit,
            'upline'        => $uplines,
            'income'        => $incomeDetails,
        ]);
    }
}
