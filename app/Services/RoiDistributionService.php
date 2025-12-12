<?php
// App/Services/RoiDistributionService.php
namespace App\Services;

use App\Models\CustomerDepositsModel;
use App\Models\CustomerEarningDetailsModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Traits\ManagesCustomerFinancials;

class RoiDistributionService
{
    use ManagesCustomerFinancials;
    /**
     * Calculate and distribute ROI for all eligible deposits for today.
     */
    public function distributeDailyRoi()
    {
        // Get all active deposits where the activation date is today or earlier
        $twelveHoursAgo = Carbon::now()->subHours(1);

        $deposits = CustomerDepositsModel::where('created_at', '<=', $twelveHoursAgo)
                                            ->get();

        foreach ($deposits as $deposit) {
            $this->processDepositRoi($deposit, $twelveHoursAgo);
        }
    }

    /**
     * Calculate and record the ROI for a single deposit.
     */
    protected function processDepositRoi(CustomerDepositsModel $deposit, Carbon $date)
    {
        // Calculate daily ROI amount
        $compound_amount = $deposit->amount + $deposit->roi_earned;
        $dailyROIAmount = $compound_amount * ($deposit->roi_percent / 100);

        // Use a transaction to ensure database consistency
        DB::transaction(function () use ($deposit, $dailyROIAmount, $compound_amount) {
            // Use the relationship defined in the CustomerDepositsModel:
            CustomerEarningDetailsModel::create([
                'app_id'             => $deposit->app_id,
                'customer_id'        => $deposit->customer_id, // Assuming user_id maps to customer_id
                'reference_id'       => $deposit->id,
                'reference_amount'   => $compound_amount,
                'amount_earned'      => $dailyROIAmount,
                'earning_type'       => 'ROI', // Use the Enum or the string 'ROI'
            ]);

            $deposit->increment('roi_earned', $dailyROIAmount);

            $finance = $this->getCustomerFinance($deposit->customer_id, $deposit->app_id);
            $finance->increment('total_roi', $dailyROIAmount);
            $finance->save();
        });
    }

    /*public function getUserDailyRoi(User $user, Carbon $date = null): float
    {
        $date = $date ?? Carbon::today();

        return (float) CustomerEarningDetail::where('customer_id', $user->id)
            ->where('earning_type', EarningType::ROI)
            ->whereDate('created_at', $date)
            ->sum('amount_distributed');
    }*/
}
