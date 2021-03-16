<?php

namespace Database\Factories;

use App\Models\Country;
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
            'country_id' => Country::FRANCE,
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
        ];
    }
}
