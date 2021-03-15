<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\OrderStatus;

class OrderFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Order::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'order_status_id' => OrderStatus::PREPARATION,
            'address_id' => \App\Models\Address::factory(),
            'user_id' => \App\Models\User::factory(),
            'shipping_id' => \App\Models\Shipping::factory(),
            'price' => mt_rand(1000, 5000),
            'shipping_fees' => 500,
            'tax' => 20,
            'has_preorder' => $this->faker->boolean,
        ];
    }
}
