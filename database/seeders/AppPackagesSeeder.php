<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PackagesModel;

class AppPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
                        [	
                            "app_id"=>1,   
                            "plan_code"=>"P1",
                            "amount"=>5,
                            "roi_percent"=>0.5,
                            "status"=>1
                        ],
                        [
                            "app_id"=>1,
                            "plan_code"=>"P2",
                            "amount"=>10,
                            "roi_percent"=>1,
                            "status"=>1
                        ],
                        [
                            "app_id"=>1,
                            "plan_code"=>"P3",
                            "amount"=>25,
                            "roi_percent"=>1.5,
                            "status"=>1
                        ],
                        [
                            "app_id"=>1,
                            "plan_code"=>"P4",
                            "amount"=>50,
                            "roi_percent"=>2,
                            "status"=>1
                        ],
                    ];

        foreach ($packages as $package) {
            PackagesModel::create($package);
        }
    }
}
