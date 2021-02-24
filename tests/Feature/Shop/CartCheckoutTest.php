<?php

namespace Tests\Feature\Shop;

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
    
}
