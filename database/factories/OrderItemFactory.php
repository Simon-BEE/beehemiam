<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;

class OrderItemFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = OrderItem::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'product_option_id' => \App\Models\ProductOption::factory(),
            'size_id' => \App\Models\Size::factory(),
            'name' => $this->faker->name,
            'price' => $this->faker->randomNumber(),
            'tax' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomNumber(),
            'is_preorder' => $this->faker->boolean(35),
        ];
    }
}
