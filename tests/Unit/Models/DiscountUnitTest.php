<?php

namespace Tests\Unit\Models;

use App\Models\Coupon;
use Tests\TestCase;

class DiscountUnitTest extends TestCase
{
    /** @test */
    public function a_coupon_has_a_property_is_expired()
    {
        $couponNoExpirationDate = Coupon::create(['code' => 'COUPONTEST', 'amount' => 10, 'expired_at' => null]);
        $couponExpireIn2Months = Coupon::create(['code' => 'COUPONTEST2', 'amount' => 10, 'expired_at' => now()->addMonths(2)]);
        $couponExpired = Coupon::create(['code' => 'COUPONTEST3', 'amount' => 10, 'expired_at' => now()->subMonth()]);

        $this->assertFalse($couponNoExpirationDate->is_expired);
        $this->assertFalse($couponExpireIn2Months->is_expired);
        $this->assertTrue($couponExpired->is_expired);
    }

    /** @test */
    public function model_coupon_has_a_scope_to_get_all_no_expired_coupons()
    {
        Coupon::factory()->create(['expired_at' => null]);
        Coupon::factory()->create(['expired_at' => null]);
        Coupon::factory()->create(['expired_at' => null]);
        Coupon::factory()->create(['expired_at' => now()->addMonths(2)]);
        Coupon::factory()->create(['expired_at' => now()->subMonth()]);

        $this->assertCount(4, Coupon::active()->get());
    }
    
}
