<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::updateOrCreate(
            ['email' => 'admin@example.com'], 
            [
                'name' => 'UppGo Admin',
                'password' => Hash::make('Admin123@'),
                'user_category' => 'non_nation',
                'role' => 'admin',
                'active' => 1,
                'deleted' => 0,
            ]
        );
    }
}
