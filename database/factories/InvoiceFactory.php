<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;

class InvoiceFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Invoice::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'address_id' => \App\Models\Address::factory(),
            'reference' => $this->faker->word,
            'full_path' => $this->faker->text,
        ];
    }
}
