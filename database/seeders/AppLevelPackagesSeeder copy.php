<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppLevelPackagesModel;
class AppLevelPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            35,10,5,4,3,3,3,2,2,2,
            1,1,1,1,1,1,1,1,1,1
        ];

        $data = [];

        for ($i = 1; $i <= 20; $i++) {
            $lvlpackage = [
                'id'         => $i,
                'app_id'     => 1,       // Added app_id
                'level'      => $i,
                'directs'    => $i - 1,  // 0 to 19
                'reward'     => $rewards[$i - 1],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            AppLevelPackagesModel::create($lvlpackage);
        }

    }
}
