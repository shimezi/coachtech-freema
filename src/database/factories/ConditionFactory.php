<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Condition;

class ConditionFactory extends Factory
{
    protected $model = Condition::class;

    public function definition()
    {
        static $conditions = [
            '新品', 'ほぼ新品', '中古', 'やや使用感あり', '傷あり'
        ];

        return [
            'condition' => array_shift($conditions),
        ];
    }
}
