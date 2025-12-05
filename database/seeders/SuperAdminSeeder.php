<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\UsersModel;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if superadmin already exists
        if (UsersModel::where('role', 'superadmin')->exists()) {
            return;
        }

        UsersModel::create([
            'name'     => 'Super Admin',
            'email'    => 'sa@app.com',
            'password' => Hash::make('sa123'),
            'role'     => 'superadmin',
            'blocked'  => false,
            'wallet_address' => null,
            'phone'          => null,
            'app_id'         => null,
            'meta'           => null,
        ]);
    }
}
