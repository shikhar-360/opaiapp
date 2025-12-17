<?php

namespace App\Services;

use App\Models\Withdrawal;
use App\Models\CustomerFinancialsModel;
use App\Models\CustomerWithdrawsModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Traits\ManagesCustomerFinancials;

class WithdrawService
{
    use ManagesCustomerFinancials;

    public function processWithdrawal($customer, $validatedData)
    {
       
        return DB::transaction(function () use ($customer, $validatedData) {

            $transactionString = Str::random(6);

            // 1. Load finance summary
            $finance = $this->getCustomerFinance($customer->id, $customer->app_id);
            // dd($finance);
            // 2. Check ROI availability
            if ($finance->total_income < $validatedData['amount']) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient income balance.',
                    'finance' => $finance
                ], 401);
            }

            // 3. Check capping limit
            $remainingCap = $finance->capping_limit-2500; // - $finance->total_withdraws;
            if ($remainingCap < $validatedData['amount']) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Exceeds withdrawal capping limit.',
                    'finance' => $finance
                ], 401);
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
            // dD($netAmount);
            // 5. Record withdrawal
            $withdraw = CustomerWithdrawsModel::create([
                'app_id'	            => $customer->app_id,
                'customer_id'	        => $customer->id,
                'admin_charge'	        => $adminFee,
                'amount'	            => $validatedData['amount'],
                'net_amount'	        => $netAmount,
                'transaction_id'	    => 'WITHDRAW-'.$transactionString,
                'transaction_type'      => 'WITHDRAW',
            ]);
            
            // 6. Update finance summary
            // $finance->decrement('total_income', $validatedData['amount']);
            // $finance->increment('total_withdraws', $validatedData['amount']);
            // $finance->decrement('capping_limit', $validatedData['amount']);
            // $finance->save();

            $withdrawAmount = $validatedData['amount'];

            // Manual assignment ignores $fillable
            $finance->total_income = max(0, $finance->total_income - $withdrawAmount);
            $finance->capping_limit = max(0, $finance->capping_limit - $withdrawAmount);
            $finance->total_withdraws += $withdrawAmount;
            $finance->save();

            return ['status'  => true, 'message' => 'Withdraw success.', 'withdraw' => $withdraw];
        });
    }
}
