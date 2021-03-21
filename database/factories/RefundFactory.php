<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Refund;

class RefundFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Refund::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'order_id' => \App\Models\Order::factory(),
            'reference' => $this->faker->word,
            'amount' => mt_rand(1000, 9999),
        ];
    }
}
