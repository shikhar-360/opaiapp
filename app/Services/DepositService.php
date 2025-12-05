<?php
namespace App\Services;

use App\Models\PackagesModel;
use App\Models\CustomerDepositsModel;

use App\Traits\ManagesCustomerFinancials;

class DepositService
{
    use ManagesCustomerFinancials;

    public function validateDepositRules($customer, $packageId, $amount)
    {
        $package = PackagesModel::find($packageId);
        
        if (!$package) {
            throw new \Exception("Invalid package ID");
        }

        // Rule 1 — amount must exactly match package amount

        if ($amount != $package->amount) {
            throw new \Exception("Amount must match the selected package deposit amount.");
        }

        // Rule 2 — incremental deposit rule
        $lastDeposit = CustomerDepositsModel::where('customer_id', $customer->id)
            ->where('payment_status', 'SUCCESS')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastDeposit && $amount < $lastDeposit->amount) {
            throw new \Exception(
                "Your next deposit must be >= last deposit amount: " . $lastDeposit->amount
            );
        }

        return $package;
    }

    public function createPendingDeposit($customer, $package, $amount, $txnId)
    {
        return CustomerDepositsModel::create([
            'app_id'        => $customer->app_id,
            'customer_id'   => $customer->id,
            'package_id'    => $package->id,
            'amount'        => $amount,
            'roi_percent'   => $package->roi_percent,
            'transaction_id'=> $txnId,
            'payment_status'=> 'PENDING',
            'coin_price'    => 2
        ]);
    }

    public function markDepositSuccess($deposit)
    {
        $deposit->update([
            'payment_status' => 'SUCCESS'
        ]);

        $finance = $this->getCustomerFinance($deposit->customer_id, $deposit->app_id);
        $finance->increment('total_deposit', $deposit->amount);
        // $finance->capping_limit = $finance->total_deposit * 3; // Need to work on capping limit logic
        $finance->save();

        return $deposit;
    }
}
