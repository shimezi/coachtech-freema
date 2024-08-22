<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        static $categories = [
            '家電', '書籍', 'ファッション', 'おもちゃ', 'ホームガーデン',
        ];

        return [
            'name' => array_shift($categories),
        ];
    }
}
