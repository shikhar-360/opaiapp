<?php
// app/Traits/ManagesUserHierarchy.php

namespace App\Traits;

use App\Models\CustomerFinancialsModel;
use Illuminate\Support\Collection;

trait ManagesCustomerFinancials
{
    /**
     * Recursively fetches all descendant User IDs using standard Eloquent.
     *
     * @param int $userId The ID of the parent user
     * @return array An array of all descendant user IDs
     */
    protected function getCustomerFinance($customerId, $appId)
    {
        return CustomerFinancialsModel::firstOrCreate([
            'customer_id' => $customerId,
            'app_id' => $appId
        ]);
    }
}
