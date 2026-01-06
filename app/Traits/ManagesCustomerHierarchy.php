<?php
// app/Traits/ManagesCustomerHierarchy.php

namespace App\Traits;

use App\Models\CustomersModel;

use Illuminate\Support\Collection;

trait ManagesCustomerHierarchy
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

    protected function getUplines($customer)
    {
        $uplines = [];

        $current = $customer;
        $depth = 1;

        while ($current->sponsor_id) {

            $sponsor = $current->sponsor;

            $directs = array_filter(explode('/', $sponsor->direct_ids ?? ''));
            $activeDirects = array_filter(explode('/', $sponsor->active_direct_ids ?? ''));

            $uplines[] = [
                "id"             => $sponsor->id,
                "name"           => $sponsor->name ?? null,     // optional
                "level"          => $depth,                    // depth from user
                "directs"        => count($directs),
                "active_directs" => count($activeDirects),
                "level_id"       => $sponsor->level_id,
                "actual_level"  => $sponsor->actual_level_id,
            ];

            $current = $sponsor;
            $depth++;
        }

        return $uplines;
    }

    protected function getLevel($customer) 
    { 
        if ($customer->referrals->isEmpty()) 
        { 
            return 1; 
        } 
        
        $maxDepth = 0; 
        foreach ($customer->referrals as $child) 
        { 
            $childDepth = $this->getLevel($child); 
            if ($childDepth > $maxDepth) 
            { 
                $maxDepth = $childDepth; 
            } 
        } 
        return $maxDepth + 1; 
    }

    protected function getDownlines($customer, $level = 1, &$downlines = [])
    {
        $children = CustomersModel::where('sponsor_id', $customer->id)->where('app_id', $customer->app_id)->where('status',1)->get();

        foreach ($children as $child) 
        {

            $directs = array_filter(explode('/', $child->direct_ids ?? ''));
            $activeDirects = array_filter(explode('/', $child->active_direct_ids ?? ''));

            $downlines[] = [
                'id'             => $child->id,
                'name'           => $child->name,
                'level'          => $level,
                'directs'        => count($directs),
                'active_directs' => count($activeDirects),
                'level_id'       => $child->level_id,
                'actual_level'   => $child->actual_level_id ?? null,
            ];

            $this->getDownlines($child, $level + 1, $downlines);
        }

        return $downlines;
    }

}
