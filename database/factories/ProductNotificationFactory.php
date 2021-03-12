<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductNotification;

class ProductNotificationFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = ProductNotification::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'product_option_id' => \App\Models\ProductOption::factory(),
            'user_id' => \App\Models\User::factory(),
            'email' => $this->faker->safeEmail,
        ];
    }
}
