<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FreeDepositPackagesModel;

class FreeDepositPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $freepackages = [
                            [	
                                'app_id' => 1,
                                'package_id' => 1,
                                'customer_id' => 5,
                                'status' => true
                            ],
                            [
                                'app_id' => 1,
                                'package_id' => 2,
                                'customer_id' => 5,
                                'status' => true
                            ]
                        ];

        foreach ($freepackages as $fpackage) {
            FreeDepositPackagesModel::create($fpackage);
        }
    }
}
