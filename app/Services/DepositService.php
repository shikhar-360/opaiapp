<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\PackagesModel;
use App\Models\CustomerDepositsModel;
use App\Models\CustomersModel;

use App\Traits\ManagesCustomerFinancials;

class DepositService
{
    use ManagesCustomerFinancials;

    public function validateDepositRules($customer, $packageId, $amount)
    {

        $package = PackagesModel::find($packageId);
        
        $finance = $this->getCustomerFinance($customer->id, $customer->app_id);

        if($finance->total_topup < $amount)
        {
            throw new \Exception("Insufficuent balance");
        }

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
            'payment_status'=> CustomerDepositsModel::STATUS_PENDING,
            'coin_price'    => 2
        ]);
    }

    public function markDepositSuccess($deposit)
    {
        DB::beginTransaction();
        try 
        {
            $deposit->update([
                'payment_status' => CustomerDepositsModel::STATUS_SUCCESS,
            ]);

            $finance = $this->getCustomerFinance($deposit->customer_id, $deposit->app_id);
            $finance->increment('total_deposit', $deposit->amount);
            $finance->decrement('total_topup', $deposit->amount); 
            $finance->save();

            $firstDeposit = CustomerDepositsModel::where('customer_id', $deposit->customer_id)
                                                ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
                                                ->where('id', '!=', $deposit->id)
                                                ->doesntExist();
            if ($firstDeposit) {
                $this->updateSponsorActiveDirects($deposit->customer_id);
            }

            DB::commit();
            return $deposit;
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            
            throw $e;
        }
    }

    protected function updateSponsorActiveDirects(int $newActiveDirectId)
    {
        $customer = CustomersModel::find($newActiveDirectId);
        
        if (!$customer || !$customer->sponsor_id) {
            return;
        }

        $sponsor = CustomersModel::find($customer->sponsor_id);

        if ($sponsor) 
        {
            // Decode the existing active directs list, initialize if null
            $activeIds = explode("/",$sponsor->active_direct_ids) ?? [];
            
            // Ensure the ID isn't already in the list (safety check for idempotency)
            if (!in_array($newActiveDirectId, $activeIds)) {
                $activeIds[] = $newActiveDirectId;
                
                // Re-encode and save back to the sponsor's record
                // $sponsor->active_direct_ids = implode("/",$activeIds);
                $sponsor->active_direct_ids = trim(($sponsor->active_direct_ids ?? '') . '/' . $newActiveDirectId, '/');
                $sponsor->save();
            }
        }
    }
}
