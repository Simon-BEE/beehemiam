<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Payment::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'reference' => $this->faker->word,
            'type' => $this->faker->word,
            'amount' => $this->faker->randomNumber(),
        ];
    }
}
