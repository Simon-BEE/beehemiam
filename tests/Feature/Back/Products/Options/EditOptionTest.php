<?php

namespace Tests\Feature\Back\Products\Options;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Tests\TestCase;

class EditOptionTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_product_option_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->create([
            'name' => 'Nom de produit',
        ]);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->get(route('admin.products.options.edit', [$product, $productOption]))
            ->assertSuccessful()
            ->assertSee($productOption->name)
        ;
    }
    

    /** @test */
    public function a_product_option_can_be_edited()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->create([
            'name' => 'Nom de produit',
        ]);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->followingRedirects()->patch(route('admin.products.options.update', [$product, $productOption]), [
            'name' => 'Option 1',
            'sku' => '9999',
            'price' => '45',
            'description' => 'Option description',
            'quantity' => 30,
        ])->assertSuccessful();

        $this->assertEquals('Option 1', $productOption->fresh()->name);
    }
}
