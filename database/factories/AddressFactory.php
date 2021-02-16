<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'country_id' => 1,
            'name' => $this->faker->word,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'street' => $this->faker->streetAddress,
            'additionnal' => $this->faker->streetName,
            'zipcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'is_main' => true,
            'is_billing' => true,
        ];
    }
}
