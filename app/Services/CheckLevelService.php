<?php

namespace App\Services;

use App\Models\UsersModel;
use App\Models\AppLevelPackagesModel;
use App\Models\CustomersModel;
use Illuminate\Support\Facades\Log;

class CheckLevelService
{
    /**
     * Check & update user level based on directs
     */
    public function checkCustomerLevel($app_id)
    {
        // 1. Get all customers
        $customers = CustomersModel::where('status', 1)->get(); 
        // change condition as per your requirement

        $results = [];

        // 2. Loop through each customer
        foreach ($customers as $customer) {

            // Count directs
            // $directsCount = CustomersModel::where('sponsor_id', $customer->id)->count();
            $directsCount = CustomersModel::join('customer_deposits', 'customer_deposits.customer_id', '=', 'customers.id')
                                            ->where('customers.sponsor_id', $customer->id)
                                            ->where('customer_deposits.payment_status', 'success')   // only successful deposits
                                            ->distinct('customers.id')
                                            ->count('customers.id');
            if($directsCount)
            {

                // Find highest qualifying level
                $levelPackage = AppLevelPackagesModel::where('app_id', $app_id)
                                                        ->where('directs', '<=', $directsCount)
                                                        ->orderBy('directs', 'DESC')
                                                        ->first();

                if ($levelPackage) 
                {
                    // Update customer level
                    CustomersModel::where('id', $customer->id)->update([
                                                                    'level_id' => $levelPackage->id
                                                                ]);
                    $results[] = [
                        'user_id' => $customer->id,
                        'directs' => $directsCount,
                        'assigned_level' => $levelPackage->id,
                    ];

                } 
                
            }
        }

        return [
            'status' => true,
            'message' => 'Levels updated for all active customers',
            'data' => $results
        ];
    }
}
