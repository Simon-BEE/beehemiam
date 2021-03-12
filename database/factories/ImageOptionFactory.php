<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ImageOption;

class ImageOptionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = ImageOption::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'product_option_id' => \App\Models\ProductOption::factory(),
            'filename' => $this->faker->word,
            'full_path' => $this->faker->text,
            'is_main' => $this->faker->boolean,
            'is_thumb' => $this->faker->boolean,
        ];
    }
}
