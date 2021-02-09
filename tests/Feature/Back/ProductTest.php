<?php

namespace Tests\Feature\Back;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;
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
    public function a_product_can_be_created_with_at_least_one_option()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->followingRedirects()->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
            'options' => [
                1 => [
                    'name' => 'Option 1',
                    'sku' => '9999',
                    'price' => '45',
                    'description' => 'Option description',
                    'images' => [
                        UploadedFile::fake()->image('option_1.jpg'),
                    ],
                ]
            ],
        ])
            ->assertSuccessful();

        // One product
        $this->assertCount(1, Product::all());
        // With one option
        $this->assertCount(1, ProductOption::all());
        $this->assertCount(1, Product::first()->productOptions);
        // With one image and its thumb
        $this->assertCount(2, Product::first()->productOptions->first()->images);
    }
    
}
