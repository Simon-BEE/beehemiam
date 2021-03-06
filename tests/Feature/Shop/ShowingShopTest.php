<?php

namespace Tests\Feature\Shop;

use App\Mail\Products\ProductAvailableMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductNotification;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Mail;
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
        $category = Category::factory()->create();
        $product = Product::factory()->active()->create();
        $category->products()->attach($product->id);
        ProductOption::factory()->create(['product_id' => $product->id]);

        $this->get(route('shop.categories.show', $category))
            ->assertSuccessful()
            ->assertViewIs('shop.categories.show')
            ->assertSee($product->name)
            ->assertSee($product->optionFormattedPrice);
    }

    /** @test */
    public function visitors_cannot_see_an_empty_category_shop_page()
    {
        $category = Category::factory()->create();

        $this->get(route('shop.categories.show', $category))
            ->assertNotFound();
    }

    /** @test */
    public function visitors_can_see_a_product_shop_page()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->active()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->get(route('shop.products.show', [$category, $product]))
            ->assertSuccessful()
            ->assertViewIs('shop.products.show')
            ->assertSee($product->name)
            ->assertSee($productOption->name);
    }

    /** @test */
    public function visitors_cannot_see_an_inactive_product_shop_page()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        ProductOption::factory()->create(['product_id' => $product->id]);

        $this->get(route('shop.products.show', [$category, $product]))
            ->assertNotFound();
    }

    /** @test */
    public function a_visitor_can_be_added_to_a_list_to_be_notified_then_product_will_be_available()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertFalse($productOption->is_available);

        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption), [
            'email' => 'example@email.net',
        ])->assertSuccessful();

        $this->assertDatabaseCount('product_notifications', 1);
        $this->assertEquals('example@email.net', ProductNotification::first()->email);
        $this->assertNull(ProductNotification::first()->user_id);
    }

    /** @test */
    public function a_user_can_be_added_to_a_list_to_be_notified_then_product_will_be_available()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $user = $this->signIn();

        $this->assertFalse($productOption->is_available);

        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption))->assertSuccessful();

        $this->assertDatabaseCount('product_notifications', 1);
        $this->assertEquals($user->email, ProductNotification::first()->user->email);
        $this->assertNull(ProductNotification::first()->email);
    }

    /** @test */
    public function an_email_is_send_to_each_email_when_a_not_available_preorder_product_become_available()
    {
        Mail::fake();
        $category = Category::factory()->create();
        $product = Product::factory()->preorder()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertFalse($productOption->is_available);

        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption), [
            'email' => 'example@email.net',
        ])->assertSuccessful();
        $this->signIn();
        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption))->assertSuccessful();

        $this->assertDatabaseCount('product_notifications', 2);
        
        $productOption->preOrderStock()->create(['quantity' => 10]);

        $this->assertTrue($productOption->fresh()->is_available);

        Mail::assertQueued(ProductAvailableMail::class, 2);
    }

    /** @test */
    public function an_email_is_send_to_each_email_when_a_not_available_product_become_available()
    {
        Mail::fake();
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertFalse($productOption->is_available);

        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption), [
            'email' => 'example@email.net',
        ])->assertSuccessful();
        $this->signIn();
        $this->followingRedirects()->post(route('shop.products.notify-availability', $productOption))->assertSuccessful();

        $this->assertDatabaseCount('product_notifications', 2);
        
        $productOption->sizes()->create(['quantity' => 10, 'size_id' => 1]);

        $this->assertTrue($productOption->fresh()->is_available);

        Mail::assertQueued(ProductAvailableMail::class, 2);
    }
    
    
}
