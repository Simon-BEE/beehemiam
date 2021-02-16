<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }

    public function preOrder()
    {
        return $this->state(function (array $attributes){
            return [
                'is_preorder' => true,
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes){
            return [
                'is_active' => true,
            ];
        });
    }
}
