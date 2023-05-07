<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id'=>Product::factory(), //外部キー制約。ProductのFactoryで生成した順に登録される
            'type'=>$this->faker->numberBetween(1,2),
            'quantity'=>$this->faker->randomNumber,
        ];
    }
}
