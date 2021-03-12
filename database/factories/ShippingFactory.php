<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shipping;

class ShippingFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Shipping::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'country_id' => \App\Models\Country::factory(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
        ];
    }
}
