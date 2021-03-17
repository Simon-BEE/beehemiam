<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PreOrderProductOptionQuantity;

class PreOrderProductOptionQuantityFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = PreOrderProductOptionQuantity::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'product_option_id' => \App\Models\ProductOption::factory(),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
