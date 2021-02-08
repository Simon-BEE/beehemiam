<?php

namespace Tests\Feature\Back;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_create_product_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.products.create'))->assertSuccessful()
            ->assertViewIs('admin.products.create')
            ->assertSee('Ajouter un nouveau vêtement')
        ;
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->followingRedirects()->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
        ])
            ->assertSuccessful();

        $this->assertCount(1, Product::all());
    }
    
}
