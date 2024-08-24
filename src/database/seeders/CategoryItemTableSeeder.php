<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Database\Seeder;

class CategoryItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();

        foreach ($items as $item) {
            $item->categories()->attach([1, 2], ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
