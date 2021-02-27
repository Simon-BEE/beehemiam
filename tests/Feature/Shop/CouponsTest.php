<?php

namespace Tests\Feature\Shop;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CouponsTest extends TestCase
{
    /** @test */
    public function an_user_can_enter_an_invalid_coupon_in_cart_page()
    {
        $this->post(route('api.cart.coupons.add'), ['coupon' => 'Patate'])
            ->assertStatus(419)
            ->assertJson(['message' => "Le code promo est invalide"]);
    }

    /** @test */
    public function an_user_can_add_a_valid_coupon_in_cart_page()
    {
        $coupon = Coupon::factory()->create();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful()
            ->assertJson([
                'message' => "Le code promo a bien été pris en compte",
                'amount' => $coupon->amount,
            ]);
    }

    /** @test */
    public function if_a_code_is_valid_coupon_is_saved_in_session()
    {
        $coupon = Coupon::factory()->create();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $coupon->fresh()]));
    }

    /** @test */
    public function if_a_user_add_another_valid_coupon_code_session_coupon_is_overwrite()
    {
        $coupon = Coupon::factory()->create();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $coupon->fresh()]));

        $couponTwo = Coupon::factory()->create();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $couponTwo->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $couponTwo->fresh()]));
    }

    /** @test */
    public function if_a_user_add_another_invalid_coupon_code_session_coupon_is_deleted()
    {
        $coupon = Coupon::factory()->create();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $coupon->fresh()]));

        $this->post(route('api.cart.coupons.add'), ['coupon' => 'Patate'])
            ->assertStatus(419);

        $this->assertNull(Session::get('coupon'));
    }
    
}
