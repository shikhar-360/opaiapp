<?php

namespace App\Services;

use App\Models\Withdrawal;
use App\Models\CustomerFinancialsModel;
use App\Models\CustomerWithdrawsModel;
use App\Models\CustomersModel;
use App\Models\AppFeePoolModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Traits\ManagesCustomerFinancials;
use App\Traits\ManagesCustomerHierarchy;
use App\Traits\DepositEligibilityTrait;

class WithdrawService
{
    use ManagesCustomerFinancials;
    use ManagesCustomerHierarchy;
    use DepositEligibilityTrait;

    public function requestWithdraw($customer, $validatedData)
    {
       
        return DB::transaction(function () use ($customer, $validatedData) {

            // $transactionString = Str::random(6);

            if($validatedData['amount'] < 10)
            {
                return response()->json([
                    'status'  => false,
                    'message' => 'Minimum $10 withdrawal amount',
                    'finance' => []
                ], 200);
            }

            // 1. Load finance summary
            $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
            // dd($finance);
            // 2. Check ROI availability
            if ($finance->total_income < $validatedData['amount']) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient income balance.',
                    'finance' => $finance
                ], 200);
            }

            // 3. Check capping limit
            
            if($this->hasPaidDeposit($customer->id))
            {
                $remainingCap = $finance->capping_limit - $finance->total_withdraws;
                if ($remainingCap < $validatedData['amount']) 
                {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Exceeds withdrawal capping limit.',
                        'finance' => $finance
                    ], 200);
                }
            }

            if($remainingCap)
            // dd($remainingCap,$validatedData);
            // 4. Calculate fees
            $adminFee = 0;
            if ($validatedData['amount'] < 100) {
                $adminFee    = $validatedData['amount'] * 0.05;
            } else {
                $adminFee    = $validatedData['amount'] * 0.05;
            }

            $netAmount = $validatedData['amount'] - $adminFee;

            $poolFees = 0;
            if ($validatedData['net_amount'] >= 100) {
                $poolFees    = $validatedData['net_amount'] * 0.05;
            } else {
                $poolFees    = 0.5;
            }

            $netAmount = $netAmount - $poolFees;

            // dD($netAmount);
            // 5. Record withdrawal
            $withdraw = CustomerWithdrawsModel::create([
                'app_id'	            => $customer->app_id,
                'customer_id'	        => $customer->id,
                'admin_charge'	        => $adminFee,
                'amount'	            => $validatedData['amount'],
                'net_amount'	        => $netAmount,
                // 'transaction_id'	    => 'WITHDRAW-'.$transactionString,
                'transaction_type'      =>  'WITHDRAW',
                'pool_fees'             => $poolFees
            ]);
            
            // 6. Update finance summary
            // $withdrawAmount = $validatedData['amount'];

            // Manual assignment ignores $fillable
            // $finance->total_income = max(0, $finance->total_income - $withdrawAmount);
            // $finance->capping_limit = max(0, $finance->capping_limit - $withdrawAmount);
            // $finance->total_withdraws += $withdrawAmount;
            // $finance->save();

            return ['status'  => true, 'message' => 'Withdraw success.', 'withdraw' => $withdraw];
        });
    }

    public function requestSelfTransfer($customer, $validatedData)
    {
        return DB::transaction(function () use ($customer, $validatedData) {

            $transactionString = Str::random(6);

            // 1. Load finance summary
            $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
            // dd($finance);
            if ($finance->total_income < $validatedData['self_amount']) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient income balance.',
                    'finance' => $finance
                ], 401);
            }

            // 5. Record selftransfer
            $transfer = CustomerWithdrawsModel::create([
                'app_id'                =>  $customer->app_id,
                'customer_id'           =>  $customer->id,
                'admin_charge'          =>  0,
                'amount'                =>  $validatedData['self_amount'],
                'net_amount'            =>  0,
                'transaction_id'        =>  'SELFTRANSFER-'.$transactionString,
                'transaction_status'    =>  'success',
                'transaction_type'      =>  'selftransfer',
                'to_customer'           =>  $customer->id,
            ]);
            
            // Manual assignment ignores $fillable
            $finance->total_income = max(0, $finance->total_income - $validatedData['self_amount']);
            $finance->total_topup = max(0, $finance->total_topup + $validatedData['self_amount']);
            $finance->save();

            return ['status'  => true, 'message' => 'Selftransfer success.', 'Transfer' => $transfer];
        });
    }

    public function requestP2PTransfer($customer, $validatedData)
    {
        return DB::transaction(function () use ($customer, $validatedData) {

            $transactionString = Str::random(6);

            // 1. Load finance summary
            $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
            // dd($finance);
            if ($finance->total_income < $validatedData['p2p_amount']) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient income balance.',
                    'finance' => $finance
                ], 401);
            }

            $uplines = $this->getUplines($customer);
            $downlines = $this->getDownlines($customer);
            $customer_team = collect($uplines)->merge($downlines);
            $customer_team_data = CustomersModel::where('referral_code', $validatedData['team_user_id'])->first();
            $name = $customer_team->firstWhere('id', $customer_team_data->id)['name'] ?? '-';

            if($name == '-')
            {

            }
            else
            {
                // 5. Record p2p transfer
                $transfer = CustomerWithdrawsModel::create([
                    'app_id'                =>  $customer->app_id,
                    'customer_id'           =>  $customer->id,
                    'to_customer'           =>  $customer_team_data->id,
                    'admin_charge'          =>  0,
                    'amount'                =>  $validatedData['p2p_amount'],
                    'net_amount'            =>  0,
                    'transaction_id'        =>  'P2PTRANSFER-'.$transactionString,
                    'transaction_status'    =>  CustomerWithdrawsModel::TRANSACTION_STATUS_SUCCESS,
                    'transaction_type'      =>  CustomerWithdrawsModel::TRANSACTION_TYPE_P2PTRANSFER,
                    'to_customer'           =>  $customer_team_data->id,
                ]);
            }
            // Manual assignment ignores $fillable
            $finance->total_income = max(0, $finance->total_income - $validatedData['p2p_amount']);
            $finance->save();

            $financeTo = $this->getCustomerFinance($customer_team_data->id, $customer_team_data->app_id);
            $financeTo->total_topup = max(0, $financeTo->total_topup + $validatedData['p2p_amount']);
            $financeTo->save();

            return ['status'  => true, 'message' => 'Selftransfer success.', 'Transfer' => $transfer];
        });
    }

    public function updateWithdraw($validatedData)
    {
        $withdraw_request = CustomerWithdrawsModel::query()
                                                ->join('customers', 'customers.id', '=', 'customer_withdraws.customer_id')
                                                ->where('customer_withdraws.id', $validatedData['request_id'])
                                                ->where('customer_withdraws.transaction_status', 'pending')
                                                ->whereNull('customer_withdraws.transaction_id')
                                                ->whereNotNull('customers.wallet_address')
                                                ->select('customer_withdraws.*','customers.wallet_address', 'customers.isWithdrawAssigned') 
                                                ->first();
        if (!$withdraw_request) {
            return response()->json((object)[], 200);
        }

        if ($withdraw_request) 
        {
            $finance = $this->getCustomerFinance($withdraw_request->customer_id, $withdraw_request->app_id);

            if((float)$finance->total_income > (float)$withdraw_request->amount)
            {
                $withdraw_request->transaction_status = 'success';
                $withdraw_request->transaction_id     = $validatedData['transaction_hash'];
                $withdraw_request->save();
                
                $customer = CustomersModel::where('id', $withdraw_request->customer_id)->where('app_id', $withdraw_request->app_id)->first();

                if (!$customer) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Customer not found'
                    ], 404);
                }

                $customer->isWithdrawAssigned = $validatedData['request_id'];
                $customer->save();

                // $finance = $this->getCustomerFinance($withdraw_request->customer_id, $withdraw_request->app_id);    
                $finance->total_income = max(0, $finance->total_income - $withdraw_request->amount);
                $finance->total_withdraws += $withdraw_request->amount;
                $finance->save();


                $feePool = AppFeePoolModel::where('app_id', $withdraw_request->app_id)
                                                ->where('network_name', 'bsc')
                                                ->latest('id')         
                                                ->lockForUpdate()
                                                ->firstOrFail();                                           
                $feePool->increment('used_amount', $withdraw_request->pool_fees);


            }
        }
    }
}
