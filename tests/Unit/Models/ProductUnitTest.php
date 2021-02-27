<?php

namespace Tests\Unit\Models;

use App\Models\ImageOption;
use App\Models\Product;
use App\Models\ProductOption;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{
    /** @test */
    public function a_preorder_product_has_access_to_his_total_stock()
    {
        $product = Product::factory()->preOrder()->create();
        ProductOption::factory()->count(2)->create(['product_id' => $product->id])->each(function (ProductOption $productOption) {
            $productOption->preOrderStock()->create(['quantity' => 10]);
        });

        $this->assertEquals(20, $product->total_stock);
    }

    /** @test */
    public function a_product_on_sale_has_access_to_his_total_stock()
    {
        $product = Product::factory()->active()->create();
        ProductOption::factory()->count(3)->create(['product_id' => $product->id])->each(function (ProductOption $productOption) {
            $productOption->sizes()->create(['quantity' => 10, 'size_id' => 1]);
        });

        $this->assertEquals(30, $product->total_stock);
    }

    /** @test */
    public function a_product_can_access_easily_to_some_properties_of_his_first_option()
    {
        $product = Product::factory()->active()->create();
        ProductOption::factory()->count(3)->create(['product_id' => $product->id]);
        ImageOption::create([
            'product_option_id' => ProductOption::first()->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);
        ImageOption::create([
            'product_option_id' => ProductOption::first()->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
            'is_thumb' => true,
        ]);

        $this->assertNotNull($product->optionDescription);
        $this->assertNotNull($product->optionImage);
        $this->assertNotNull($product->optionThumbImage);
        $this->assertNotNull($product->optionName);
        $this->assertNotNull($product->optionFormattedPrice);
        $this->assertEquals($product->optionDescription, ProductOption::first()->description);
    }
    
    /** @test */
    public function model_product_has_a_scope_to_get_only_active_products()
    {
        Product::factory()->count(10)->active()->create();
        Product::factory()->count(5)->create();

        $this->assertCount(15, Product::all());
        $this->assertCount(10, Product::active()->get());
    }
    
}
