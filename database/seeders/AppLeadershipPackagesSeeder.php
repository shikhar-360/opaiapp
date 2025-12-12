<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AppLeadershipPackagesModel;

class AppLeadershipPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = ["gold","sapphire","emrald","ruby","diamond"];

        $volumes = [1000,2000,4000,8000,16000];

        $points = [5,10,20,80,160];

        $data = [];

        for ($i = 0; $i < count($ranks); $i++) {
            $lspackage = [
                'app_id'     => 1,       
                'rank'      => $ranks[$i],
                'volume'    => $volumes[$i],
                'points'     => $points[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            AppLeadershipPackagesModel::create($lspackage);
        }
    }
}
