<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            ConditionTableSeeder::class,
            ItemTableSeeder::class,
            CategoryItemTableSeeder::class,
        ]);
    }
}
