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
            'price' => '47000',
            'description' => '<p>カラー : グレー</p><P>新品</P><p>商品の状態は良好です。傷もありません。</p><p>購入後、即発送いたします。</p>',
            'img_url' => asset('storage/items/dummy.png'),
            'user_id' => 1,
            'condition_id' => 1,
        ];
    }
}
