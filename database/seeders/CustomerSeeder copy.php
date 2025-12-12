<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomersModel;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
                        [
                            'app_id'         => 1,
                            'name'           => 'Rahul Sharma',
                            'email'          => 'rahul@app.com',
                            'phone'          => '9000000001',
                            'password'       => Hash::make('123'),
                            'wallet_address' => '0x1111111111111111111111111111111111111111',
                            'referral_code'  => '111111',
                            'sponsor_id'     => null,  // root has no parent
                            'direct_ids'       => '2',
                        ],
                        [
                            'app_id'         => 1,
                            'name'           => 'Priya Verma',
                            'email'          => 'priya@app.com',
                            'phone'          => '9000000002',
                            'password'       => Hash::make('123456'),
                            'wallet_address' => '0x2222222222222222222222222222222222222222',
                            'referral_code'  => '222222',
                            'sponsor_id'     => 1,  // sponsored by root customer
                            'direct_ids'       => '3',
                        ],
                        [
                            'app_id'         => 1,
                            'name'           => 'Vikram Singh',
                            'email'          => 'vikram@app.com',
                            'phone'          => '9000000003',
                            'password'       => Hash::make('123'),
                            'wallet_address' => '0x3333333333333333333333333333333333333333',
                            'referral_code'  => '333333',
                            'sponsor_id'     => 2, // under Customer A
                            'direct_ids'       => '',
                        ],
                    ];

        foreach ($customers as $customer) {
            CustomersModel::create($customer);
        }
    }
}
