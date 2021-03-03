<?php

namespace Tests\Feature\Shop;

use App\Models\Category;
use App\Models\ImageOption;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /** @test */
    public function a_user_can_access_to_search_page()
    {
        $this->get(route('shop.search.index'))
            ->assertSuccessful()
            ->assertViewIs('shop.search.index');
    }

    /** @test */
    public function a_user_can_search_for_products()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->active()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'name' => 'Vêtement']);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image_thumb.jpg',
            'is_thumb' => true,
        ]);

        $this->get(route('shop.search.index', [
            'q' => 'vêtement'
        ]))
            ->assertSuccessful()
            ->assertSee($product->name);
    }
    
    
}
