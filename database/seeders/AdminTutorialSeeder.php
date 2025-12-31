<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AdminTutorialsModel;

class AdminTutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminTutorialsModel::create([
            'app_id'        => 1,
            'resource_type' => 'video',
            'title'         => 'Getting Started',
            'sub_title'     => 'Admin Panel Overview',
            'url'           => 'https://www.youtube.com/watch?v=xxxxxx',
            'created_by'    => 1,
        ]);
    }
}
