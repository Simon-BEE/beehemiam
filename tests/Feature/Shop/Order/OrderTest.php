<?php

namespace Tests\Feature\Shop\Order;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function a_person_cannot_see_order_page_if_no_products_in_cart_an_no_addresses()
    {
        $this->get(route('cart.orders.index'))
            ->assertRedirect()
            ->assertSessionHas('type', 'Erreur');
    }

    /** @test */
    public function an_unlogged_user_can_see_order_page()
    {
        $this->addAProductToCart();
        $this->setSessionAddress();

        $this->get(route('cart.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.orders.index');
    }

    /** @test */
    public function a_logged_user_can_see_order_page()
    {
        $this->addAProductToCart();
        $user = $this->signIn();
        Address::factory()->create(['user_id' => $user->id]);

        $this->get(route('cart.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.cart.orders.index');
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

    private function setSessionAddress(): void
    {
        $this->followingRedirects()->post(route('cart.shippings.store'), [
            'country_id' => 1,
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'street' => '30 rue des cocotiers',
            'additionnal' => '2ème étage',
            'zipcode' => '13100',
            'city' => 'Marseille',
            'phone' => '0615141213',
            'email' => 'email@email.com',
        ])
            ->assertSuccessful();
    }

}
