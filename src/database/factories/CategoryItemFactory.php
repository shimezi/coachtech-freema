<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryItemFactory extends Factory
{
    protected $model = \App\Models\CategoryItem::class;

    public function definition()
    {
        $item = Item::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'item_id' => $item ? $item->id : Item::factory()->create()->id,
            'category_id' => $category ? $category->id : Category::factory()->create()->id,
        ];
    }
}
