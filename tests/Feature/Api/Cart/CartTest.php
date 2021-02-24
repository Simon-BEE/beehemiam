<?php

namespace Tests\Feature\Api\Cart;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Gloudemans\Shoppingcart\Facades\Cart;
use Tests\TestCase;

class CartTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    
        // Cart::destroy();
    }

    /** @test */
    public function a_product_option_size_can_be_added_to_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertCount(1, Cart::content());
        $this->assertTrue(Cart::content()->contains('id', $productOptionSize->id));
    }

    /** @test */
    public function a_product_option_can_be_retrieve_in_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertEquals($productOptionSize->id, Cart::get(get_cart_row_id($productOptionSize))->id);
    }

    /** @test */
    public function a_product_option_can_be_updated_in_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->patch(route('api.cart.update.sizes', $productOptionSize), ['quantity' => 2])
            ->assertSuccessful();

        $this->assertEquals(2, Cart::get(get_cart_row_id($productOptionSize))->qty);
    }

    /** @test */
    public function if_a_product_option_size_exists_already_in_cart_quantity_will_be_updated()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertEquals(2, Cart::get(get_cart_row_id($productOptionSize))->qty);
    }
    
}