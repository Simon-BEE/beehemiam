<?php

namespace Tests\Feature\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class CartCheckoutTest extends TestCase
{
    /** @test */
    public function cart_page_is_accessible()
    {
        $this->get(route('cart.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.index');
    }

    /** @test */
    public function cart_shipping_address_page_is_not_accessible_if_cart_is_empty()
    {
        $this->get(route('cart.shippings'))
            ->assertRedirect(route('shop.categories.index'));
    }

    /** @test */
    public function cart_shipping_address_page_is_accessible()
    {
        $this->addAProductToCart();

        $this->get(route('cart.shippings'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.shipping');
    }

    private function addAProductToCart(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();
    }
}
