<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => '洋服']);
        Category::create(['name' => 'メンズ']);
    }
}

