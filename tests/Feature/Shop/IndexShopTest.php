<?php

namespace Tests\Feature\Shop;

use Tests\TestCase;

class IndexShopTest extends TestCase
{
    /** @test */
    public function visitors_can_see_shop_page()
    {
        $this->get(route('shop.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.index');
    }
    
}
