<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class CategoryUnitTest extends TestCase
{
    /** @test */
    public function categories_can_be_retreieve_if_they_have_products_only()
    {
        $categoryWithActiveProduct = Category::factory()->create();
        $productActive = Product::factory()->active()->create();
        $categoryWithActiveProduct->products()->attach($productActive->id);
        $categoryWithoutActiveProduct = Category::factory()->create();
        $productInactive = Product::factory()->create();
        $categoryWithoutActiveProduct->products()->attach($productInactive->id);

        $this->assertCount(1, Category::active()->get());
    }
    
    /** @test */
    public function a_category_has_a_property_img_with_unsplash_api()
    {
        $category = Category::factory()->create();

        $this->assertNotNull($category->image);
    }
    
}
