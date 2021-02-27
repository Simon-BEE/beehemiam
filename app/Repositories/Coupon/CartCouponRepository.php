<?php

namespace App\Repositories\Coupon;

use App\Exceptions\Coupon\CouponDoesNotExistException;
use App\Models\Coupon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartCouponRepository
{
    private Collection $coupons;

    public function __construct()
    {
        $this->coupons = Coupon::active()->get();
    }

    public function userAddCoupon(string $couponCode): int
    {
        $this->checkIfCouponExists($couponCode);

        $coupon = $this->coupons->firstWhere('code', $couponCode);

        $this->saveInSession($coupon);

        return $coupon->amount;
    }

    private function saveInSession(Coupon $coupon): void
    {
        Session::put(
            'coupon', 
            collect(['is_active' => false, 'coupon' => $coupon])
        );
    }

    private function clearCouponSession(): void
    {
        Session::forget('coupon');
    }

    private function checkIfCouponExists(string $couponCode): void
    {
        if (!$this->coupons->contains('code', $couponCode)) {
            $this->clearCouponSession();

            throw new CouponDoesNotExistException("Le code promo est invalide", 1);
        }
    }
}
