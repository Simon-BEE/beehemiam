<?php

namespace Tests\Feature\Back\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Tests\TestCase;

class EditProductTest extends TestCase
{
   /** @test */
   public function an_admin_can_see_product_edit_form()
   {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Category::factory()->create();
        $product = Product::factory()->create();

        $this->get(route('admin.products.edit', $product))->assertSuccessful()
            ->assertViewIs('admin.products.edit')
            ->assertSee('Modifier le vêtement : ' . $product->name)
            ->assertSee(Category::inRandomOrder()->first()->name)
        ;
   }
   
}
