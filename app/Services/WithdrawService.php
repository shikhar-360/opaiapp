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

    public function processWithdrawal($customer, $amount)
    {
        return DB::transaction(function () use ($customer, $amount) {

            $transactionString = Str::random(6);

            // 1. Load finance summary
            $finance = $this->getCustomerFinance($customer->id, $customer->app_id);

            // 2. Check ROI availability
            if ($finance->total_roi < $amount) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient ROI balance.',
                    'finance' => $finance
                ], 401);
            }

            // 3. Check capping limit
            $remainingCap = $finance->capping_limit - $finance->total_withdraws;
            if ($remainingCap < $amount) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Exceeds withdrawal capping limit.',
                    'finance' => $finance
                ], 401);
            }

            // 4. Calculate fees
            if ($amount < 100) {
                $withdrawFee = $amount * 0.05;
                $adminFee    = $amount * 0.005;
            } else {
                $withdrawFee = $amount * 0.10;
                $adminFee    = $amount * 0.01;
            }

            $totalFee = $withdrawFee + $adminFee;
            $finalAmount = $amount - $totalFee;

            // 5. Record withdrawal
            $withdraw = CustomerWithdrawsModel::create([
                'app_id'	            => $customer->app_id,
                'customer_id'	        => $customer->id,
                'admin_charge'	        => $amount,
                'fees'	                => $amount,
                'coin_price'            => $amount,
                'amount'	            => $amount,
                'admin_charge_amount'	=> $amount,
                'fees_amount'           => $amount,
                'net_amount'	        => $amount,
                'transaction_id'	    => 'WITHDRAW-'.$transactionString,
                'transaction_type'      => 'WITHDRAW',
            ]);

            // 6. Update finance summary
            $finance->decrement('total_roi', $amount);
            $finance->increment('total_withdraws', $amount);

            return $withdraw;
        });
    }
}
