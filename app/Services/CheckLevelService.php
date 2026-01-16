<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

use App\Models\UsersModel;
use App\Models\AppLevelPackagesModel;
use App\Models\CustomersModel;

use App\Traits\ManagesCustomerHierarchy;

class CheckLevelService
{
    use ManagesCustomerHierarchy;
    /**
     * Check & update user level based on directs
     */
    public function checkCustomerLevelAll($app_id)
    {
        // 1. Get all customers
        $customers = CustomersModel::where('status', 1)->where('app_id', $app_id)->where('id','>', 1)->get(); 
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
                    if($customer->id>1)
                    {
                        CustomersModel::where('id', $customer->id)->update([
                                                                    'level_id' => $levelPackage->id
                                                                ]);
                    }
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

    public function checkCustomerLevel($customer)
    {
        $directsCount = CustomersModel::join('customer_deposits', 'customer_deposits.customer_id', '=', 'customers.id')
                                            ->where('customers.sponsor_id', $customer->id)
                                            ->where('customer_deposits.payment_status', 'success')   // only successful deposits
                                            ->where('customer_deposits.is_free_deposit', 0)
                                            ->distinct('customers.id')
                                            ->count('customers.id');

        $levelPackage = AppLevelPackagesModel::where('app_id', $customer->app_id)
                                                        ->where('directs', '<=', $directsCount)
                                                        ->orderBy('directs', 'DESC')
                                                        ->first();
        $results = [];
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

        return [
            'status' => true,
            'message' => 'Levels updated',
            'data' => $results
        ];
    }

    /*public function checkCustomerLevel($customer)
    {
        $directsCount = CustomersModel::join('customer_deposits', 'customer_deposits.customer_id', '=', 'customers.id')
            ->where('customers.sponsor_id', $customer->id)
            ->where('customer_deposits.payment_status', 'success')
            ->where('customer_deposits.is_free_deposit', 0)
            ->distinct('customers.id')
            ->count('customers.id');

        $levelPackage = AppLevelPackagesModel::where('app_id', $customer->app_id)
            ->where('directs', '<=', $directsCount)
            ->orderBy('directs', 'DESC')
            ->first();

        return $levelPackage?->id; // 👈 only return level id
    }*/

    public function updateCustomerActualLevel()
    {

        CustomersModel::where('status', 1)
                        ->chunk(200, function ($customers) {
                            foreach ($customers as $customer) {
                                /*$customer->update([
                                    'actual_level_id' => $this->getLevel($customer) ?? 1
                                ]);*/

                                $level = $this->getLevel($customer) ?? 1;

                                $customer->update([
                                    'actual_level_id' => $level
                                ]);
                                
                                /*Log::info('Customer level updated', [
                                                                        'customer_id' => $customer->id,
                                                                        'actual_level' => $level,
                                                                    ]);*/
                            }
                        });
        // Log::info('Customer actual levels checked successfully.');
    }
}
