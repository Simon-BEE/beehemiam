<?php

namespace App\Repositories\Coupon;

use App\Exceptions\Coupon\CouponDoesNotExistException;
use App\Exceptions\Coupon\CouponIsNotEligibleException;
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
        $this->clearCouponSession();

        $this->checkIfCouponExists($couponCode);

        $coupon = $this->coupons->firstWhere('code', $couponCode);

        $this->checkIfCartAmountIsEnoughToApplyCoupon($coupon);

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
            throw new CouponDoesNotExistException("Le code promo est invalide", 1);
        }
    }

    private function checkIfCartAmountIsEnoughToApplyCoupon(Coupon $coupon): void
    {
        if (get_cart_subtotal(true) < config('beehemiam.coupons.minimum_amount')
            || (get_cart_subtotal(true) - $coupon->amount) < config('beehemiam.orders.minimum_price')
        ) {
            throw new CouponIsNotEligibleException("Le code promo ne peut pas être appliqué au panier", 1);
        }
    }
}
