<?php

namespace Tests\Unit\Models;

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
}
