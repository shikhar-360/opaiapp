<?php

namespace App\Services;

use App\Models\CustomersModel;
use Illuminate\Support\Facades\DB;

use App\Traits\ManagesCustomerHierarchy;

class GenealogyService
{

    use ManagesCustomerHierarchy;
    /**
     * Build the nested genealogy tree starting from a given user ID.
     *
     * @param int $userId The ID of the root user.
     * @return array The nested data structure ready for a view.
     */
    public function buildGenealogyTree(int $userId): array
    {
        // Start by fetching the top-level user
        $rootUser = CustomersModel::find($userId);

        if (!$rootUser) {
            return [];
        }

        // Use a recursive helper function to build the full tree structure
        $tree = [$this->formatCustomerNode($rootUser)];
        
        return $tree;
    }

    /**
     * Recursively formats a customer node and builds children using the direct_ids column.
     */
    protected function formatCustomerNode(CustomersModel $customer): array
    {
        // $levelid = $this->getLevel($customer);
        // 1. Calculate metrics for this specific user efficiently
        $metrics = $this->calculateMetrics($customer->id);

        // 2. Build the base node structure (matches your desired output format)
        $node = [
            "refferal_code"      => $customer->referral_code,
            "wallet_address"     => $customer->wallet_address,
            "level_id"           => $customer->level_id, // Placeholder: Add your rank logic here
            "currentPackageDate" => $customer->created_at->format('Y-m-d'),
            "my_team"            => $metrics['total_team_count'],
            "my_direct"          => $metrics['total_direct_count'],
            "team_investment"    => $metrics['total_team_investment'],
            "direct_investment"  => $metrics['direct_investment'],
            "totalInvestment"    => $metrics['my_investment'],
            "children"           => [], // Initialize the children array
        ];

        // 3. Recursively add children (downline) using the 'direct_ids' column
        $directIdsString = $customer->direct_ids ?? '';
        $childrenIds = array_filter(explode('/', $directIdsString));

        if (!empty($childrenIds)) {
            $childrenModels = CustomersModel::whereIn('id', $childrenIds)->get();

            foreach ($childrenModels as $childModel) {
                // The magic of recursion: call this same function for each child
                $node['children'][] = $this->formatCustomerNode($childModel);
            }
        }

        return $node;
    }

    /**
     * Calculates key metrics for a given user ID using efficient DB lookups.
     */
    protected function calculateMetrics(int $userId): array
    {
        // Calculate all necessary team IDs recursively
        $allTeamIds = $this->getRecursiveTeamIds($userId);
        $directIds = $this->getDirectIds($userId);

        // Calculate team investment using the recursive IDs
        $totalTeamInvestment = 0;
        if (!empty($allTeamIds)) {
            $totalTeamInvestment = DB::table('customer_deposits')
                ->whereIn('customer_id', $allTeamIds)
                ->where('payment_status', 'success')
                ->sum('amount') ?? 0;
        }

        // Calculate direct investment using only direct IDs
        $directInvestment = 0;
        if (!empty($directIds)) {
             $directInvestment = DB::table('customer_deposits')
                ->whereIn('customer_id', $directIds)
                ->where('payment_status', 'success')
                ->sum('amount') ?? 0;
        }

        return [
            'my_investment'         => DB::table('customer_deposits')
                ->where('customer_id', $userId)
                ->where('payment_status', 'success')
                ->sum('amount') ?? 0,
            
            'total_direct_count'    => count($directIds),
            'total_team_count'      => count($allTeamIds),
            'direct_investment'     => $directInvestment,
            'total_team_investment' => $totalTeamInvestment,
        ];
    }


    // --- Helper Functions to get ID lists ---

    /**
     * Helper to get direct IDs from the string column
     */
    protected function getDirectIds(int $userId): array
    {
        $customer = CustomersModel::find($userId, ['direct_ids']);
        if (!$customer) {
            return [];
        }
        return array_filter(explode('/', $customer->direct_ids ?? ''));
    }

    /**
     * Recursively fetches all descendant User IDs using standard Eloquent (from previous chats)
     */
    protected function getRecursiveTeamIds(int $userId): array
    {
        $teamIds = [];
        $directReferrals = CustomersModel::where('sponsor_id', $userId)->pluck('id')->toArray();

        if (empty($directReferrals)) {
            return [];
        }

        foreach ($directReferrals as $referralId) {
            $teamIds[] = $referralId;
            $teamIds = array_merge($teamIds, $this->getRecursiveTeamIds($referralId));
        }

        return array_unique($teamIds);
    }
}
