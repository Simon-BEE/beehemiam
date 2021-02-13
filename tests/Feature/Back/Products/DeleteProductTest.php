<?php

namespace Tests\Feature\Back\Products;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /** @test */
    public function a_product_can_be_deleted()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->create();

        $this->followingRedirects()->delete(route('admin.products.destroy', $product))
            ->assertSuccessful();

        $this->assertNull($product->fresh());
    }
}
