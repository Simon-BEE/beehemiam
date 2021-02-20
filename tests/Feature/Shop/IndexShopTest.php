<?php

namespace Tests\Feature\Shop;

use Tests\TestCase;

class IndexShopTest extends TestCase
{
    /** @test */
    public function visitors_can_see_categories_shop_page()
    {
        $this->get(route('shop.categories.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.categories.index');
    }

    /** @test */
    public function visitors_can_see_a_category_shop_page()
    {
        $this->get(route('shop.categories.show'))
            ->assertSuccessful()
            ->assertViewIs('shop.categories.show');
    }
    
}
