<?php
// app/Traits/ManagesUserHierarchy.php

namespace App\Traits;

use App\Models\CustomersModel;
use Illuminate\Support\Collection;

trait ManagesUserHierarchy
{
    /**
     * Recursively fetches all descendant User IDs using standard Eloquent.
     *
     * @param int $userId The ID of the parent user
     * @return array An array of all descendant user IDs
     */
    protected function getRecursiveTeamIds(int $userId): array
    {
        $teamIds = [];
        // Use pluck() and toArray() for efficiency
        $directReferrals = CustomersModel::where('sponsor_id', $userId)->pluck('id')->toArray();

        if (empty($directReferrals)) {
            return [];
        }

        foreach ($directReferrals as $referralId) {
            $teamIds[] = $referralId;
            // Merge the IDs from the next level down recursively
            $teamIds = array_merge($teamIds, $this->getRecursiveTeamIds($referralId));
        }

        // Return unique IDs just in case of any data anomalies
        return array_unique($teamIds);
    }
}
