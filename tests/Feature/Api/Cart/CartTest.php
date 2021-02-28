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
    
        Cart::destroy();
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

        $this->assertCount(1, Cart::instance('order')->content());
        $this->assertTrue(Cart::instance('order')->content()->contains('id', $productOptionSize->id));
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

        $this->assertEquals($productOptionSize->id, Cart::instance('order')->get(get_cart_row_id($productOptionSize))->id);
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

        $this->assertEquals(2, Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty);
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

        $this->assertEquals(2, Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty);
    }

    /** @test */
    public function if_a_product_option_size_has_quantity_zero_so_its_removed_from_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertCount(1, Cart::instance('order')->content());

        $this->patch(route('api.cart.update.sizes', $productOptionSize), ['quantity' => 0])
            ->assertSuccessful();

        $this->assertCount(0, Cart::instance('order')->content());
    }
    
    /** @test */
    public function a_product_can_be_removed_from_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $productOptionSize = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertCount(1, Cart::instance('order')->content());

        $this->delete(route('api.cart.delete.sizes', $productOptionSize))
            ->assertSuccessful();

        $this->assertCount(0, Cart::instance('order')->content());
    }
    
    /** @test */
    public function sum_of_products_in_cart_can_be_rerieve_easily()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 15]);
        $productOptionSize1 = $productOption->sizes()->create(['size_id' => 1, 'quantity' => 10]);
        $productOptionSize2 = $productOption->sizes()->create(['size_id' => 2, 'quantity' => 10]);

        $this->post(route('api.cart.add.sizes', $productOptionSize1))
            ->assertSuccessful();
        $this->post(route('api.cart.add.sizes', $productOptionSize2))
            ->assertSuccessful();

        $this->assertCount(2, Cart::instance('order')->content());
        $this->assertEquals(30, get_cart_subtotal(true));
        $this->assertEquals(3000, get_cart_subtotal());
    }
    
    /** @test */
    public function a_preorder_product_can_be_added_to_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->preorder()->active()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 15]);
        $productOption->preOrderStock()->create(['quantity' => 10]);

        $this->post(route('api.cart.add.preorder'), [
            'product_option_id' => $productOption->id,
            'size_id' => 1,
        ])
            ->assertSuccessful();

        $this->assertCount(1, Cart::instance('preorder')->content());
        $this->assertTrue(Cart::instance('preorder')->content()->contains('id', $productOption->id));
    }

    /** @test */
    public function a_preorder_product_option_can_be_updated_in_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->preorder()->active()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 15]);
        $productOption->preOrderStock()->create(['quantity' => 10]);

        $this->post(route('api.cart.add.preorder'), [
            'product_option_id' => $productOption->id,
            'size_id' => 1,
        ]);

        $this->patch(route('api.cart.update.preorder'), [
            'quantity' => 2,
            'product_option_id' => $productOption->id,
            'size_id' => 1,
        ])
            ->assertSuccessful();

        $this->assertEquals(2, Cart::instance('preorder')->get(get_cart_row_id($productOption, 'preorder', 1))->qty);
    }
    
    /** @test */
    public function a_preorder_product_can_be_removed_from_cart()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->preorder()->active()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id, 'price' => 15]);
        $productOption->preOrderStock()->create(['quantity' => 10]);

        $this->post(route('api.cart.add.preorder'), [
            'product_option_id' => $productOption->id,
            'size_id' => 1,
        ]);

        $this->assertCount(1, Cart::instance('preorder')->content());

        $this->delete(route('api.cart.delete.preorder'), [
            'product_option_id' => $productOption->id,
            'size_id' => 1,
        ])
            ->assertSuccessful();

        $this->assertCount(0, Cart::instance('preorder')->content());
    }
}
