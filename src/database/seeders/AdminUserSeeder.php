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
        user::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'is_admin' => true,
        ]);
    }
}
