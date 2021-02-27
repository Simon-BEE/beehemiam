<?php

namespace App\Repositories\Coupon;

use App\Models\Coupon;

class CouponRepository
{
    public function save(array $validatedData): Coupon
    {
        return Coupon::create($validatedData);
    }

    public function update(Coupon $coupon, array $validatedData): Coupon
    {
        return tap($coupon)->update($validatedData);
    }

    public function delete(Coupon $coupon): void
    {
        $coupon->delete();
    }
}
