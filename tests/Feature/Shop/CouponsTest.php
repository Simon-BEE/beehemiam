<?php

namespace Tests\Feature\Shop;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductOption;
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
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 100]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

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
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 100]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $coupon->fresh()]));
    }

    /** @test */
    public function if_a_user_add_another_valid_coupon_code_session_coupon_is_overwrite()
    {
        $coupon = Coupon::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 100]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

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
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 100]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->assertEquals(Session::get('coupon'), collect(['is_active' => false, 'coupon' => $coupon->fresh()]));

        $this->post(route('api.cart.coupons.add'), ['coupon' => 'Patate'])
            ->assertStatus(419);

        $this->assertNull(Session::get('coupon'));
    }

    /** @test */
    public function if_coupon_is_valid_but_cart_total_less_than_20_cannot_apply_coupon()
    {
        $coupon = Coupon::factory()->create(['amount' => 15]);
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 20]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertStatus(419)
            ->assertJson(['message' => "Le code promo ne peut pas être appliqué au panier"]);

        $this->assertNull(Session::get('coupon'));
    }

    /** @test */
    public function if_coupon_was_valid_but_cart_is_updated_and_no_more_eligible_so_coupon_is_removed()
    {
        $coupon = Coupon::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 100]);
        $productOption2 = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 10]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);
        $productOptionSize2 = $productOption2->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->post(route('api.cart.add.sizes', $productOptionSize2))
            ->assertSuccessful();

        $this->post(route('api.cart.coupons.add'), ['coupon' => $coupon->code])
            ->assertSuccessful();

        $this->delete(route('api.cart.delete.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertNull(Session::get('coupon'));
    }

}
