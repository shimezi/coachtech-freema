<?php

namespace Database\Factories;

use App\Models\Condition;
use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $condition = Condition::inRandomOrder()->first();

        return [
            'name' => 'ブランド名',
            'price' => '47,000',
            'description' => '商品説明',
            'img_url' => 'https://via.placeholder.com/640x480.png',
            'user_id' => $user ? $user->id : User::factory()->create()->id,
            'condition_id' => $condition ? $condition->id : Condition::factory()->create()->id,
        ];
    }
}
