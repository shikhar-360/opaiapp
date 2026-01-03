<?php

namespace App\Traits;

use App\Models\CustomerDepositsModel;

trait DepositEligibilityTrait
{
    protected function hasAnyDeposit(int $customerId): bool
    {
        return CustomerDepositsModel::where('customer_id', $customerId)
            ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
            ->exists();
    }

    protected function hasPaidDeposit(int $customerId): bool
    {
        return CustomerDepositsModel::where('customer_id', $customerId)
            ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
            ->where('is_free_deposit', 0)
            ->exists();
    }

    protected function hasFreeDeposit(int $customerId): bool
    {
        return CustomerDepositsModel::where('customer_id', $customerId)
            ->where('payment_status', CustomerDepositsModel::STATUS_SUCCESS)
            ->where('is_free_deposit', 1)
            ->exists();
    }

    protected function hasOnlyFreeDeposit(int $customerId): bool
    {
        return $this->hasAnyDeposit($customerId)
            && $this->hasFreeDeposit($customerId)
            && !$this->hasPaidDeposit($customerId);
    }

    protected function hasNoDeposit(int $customerId): bool
    {
        return !$this->hasAnyDeposit($customerId);
    }
}
