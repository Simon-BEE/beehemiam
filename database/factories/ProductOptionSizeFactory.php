<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductOptionSize;

class ProductOptionSizeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = ProductOptionSize::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'product_option_id' => \App\Models\ProductOption::factory(),
            'size_id' => \App\Models\Size::factory(),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
