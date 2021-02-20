<?php

namespace Tests\Feature\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class ShowingShopTest extends TestCase
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
        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->get(route('shop.categories.show', $category))
            ->assertSuccessful()
            ->assertViewIs('shop.categories.show')
            ->assertSee($product->name)
            ->assertSee($product->optionFormattedPrice);
    }
    
}
