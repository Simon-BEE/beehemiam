<?php

namespace Tests\Feature\Back\Products;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class IndexProductTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_index_page_of_products()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Product::factory()->count(10)->create();

        $this->get(route('admin.products.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.products.index')
            ->assertSee('Voir tous les vêtements')
            ->assertSee(Product::inRandomOrder()->first()->name)
        ;
    }
}
