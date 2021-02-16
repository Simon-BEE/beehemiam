<?php

namespace Tests\Feature\Back\Products\Options;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Tests\TestCase;

class DeleteOptionTest extends TestCase
{
    /** @test */
    public function a_product_option_can_be_deleted()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->create([
            'name' => 'Nom de produit',
        ]);
        $productOption = ProductOption::factory()->create([
            'product_id' => $product->id,
        ]);

        $this->followingRedirects()->delete(route('admin.products.options.destroy', [$product, $productOption]))
            ->assertSuccessful();

        $this->assertCount(0, $product->productOptions);
    }

    /** @test */
    public function a_product_is_set_offline_if_its_only_option_is_deleted()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->active()->create([
            'name' => 'Nom de produit',
        ]);
        $productOption = ProductOption::factory()->create([
            'product_id' => $product->id,
        ]);

        $this->assertTrue($product->is_active);
        
        $this->followingRedirects()->delete(route('admin.products.options.destroy', [$product, $productOption]))
            ->assertSuccessful();
        
        $this->assertFalse($product->fresh()->is_active);
    }
}
