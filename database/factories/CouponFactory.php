<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => "COUPON" . mt_rand(10, 99),
            'amount' => mt_rand(1, 50),
            'expired_at' => now()->addWeeks(mt_rand(1,5)),
        ];
    }
}
