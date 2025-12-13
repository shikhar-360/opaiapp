<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AppLeadershipIncomeModel;

class AppLeadershipIncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks   = ["GOLD", "SAPPHIRE", "EMERALD", "RUBY", "DIAMOND"];
        $volumes = [1000, 2000, 4000, 8000, 16000];
        $points  = [5, 10, 20, 80, 160];

        for ($i = 0; $i < count($ranks); $i++) {
            AppLeadershipIncomeModel::create([
                'app_id'       => 1,
                'rank'         => $ranks[$i],
                'team_volume'  => $volumes[$i],
                'points'       => $points[$i],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
