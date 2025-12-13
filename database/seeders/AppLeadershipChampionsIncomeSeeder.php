<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AppLeadershipChampionsIncomeModel;

class AppLeadershipChampionsIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $championRanks   = ["VIP1", "VIP2", "VIP3", "VIP4", "VIP5"];
        $directs         = [10, 20, 30, 40, 50];
        $teamVolumes     = [1000, 2000, 3000, 4000, 5000];
        $championPoints  = [100, 200, 300, 400, 500];

        for ($i = 0; $i < count($championRanks); $i++) {
            AppLeadershipChampionsIncomeModel::create([
                'app_id'       => 1,
                'rank'         => $championRanks[$i],
                'directs'      => $directs[$i],
                'team_volume'  => $teamVolumes[$i],
                'points'       => $championPoints[$i],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
