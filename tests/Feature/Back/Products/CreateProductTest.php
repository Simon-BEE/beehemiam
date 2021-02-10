<?php

namespace Tests\Feature\Back\Products;

use App\Models\Category;
use App\Models\ImageOption;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_create_product_form_if_exists_at_least_one_category()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Category::factory()->create();

        $this->get(route('admin.products.create'))->assertSuccessful()
            ->assertViewIs('admin.products.create')
            ->assertSee('Ajouter un nouveau vêtement')
        ;
    }

    /** @test */
    public function an_admin_is_redirect_if_no_category_exists()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.products.create'))->assertRedirect(route('admin.categories.create'));
    }

    /** @test */
    public function a_product_can_be_created_with_at_least_one_option()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Category::factory()->create();

        $this->followingRedirects()->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
            'categories' => [1],
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
        ])->assertSuccessful();

        // One product
        $this->assertCount(1, Product::all());
        // With one option
        $this->assertCount(1, ProductOption::all());
        $this->assertCount(1, Product::first()->productOptions);
        // With one image and its thumb
        $this->assertCount(2, Product::first()->productOptions()->first()->images);
        // With at least one category attached
        $this->assertCount(1, Product::first()->categories);
    }

    /** @test */
    public function a_product_option_price_is_converted_in_cents()
    {
        $product = Product::factory()->create();
        $productOption = ProductOption::factory()->create([
            'product_id' => $product->id,
            'price' => 56,
        ]);

        $this->assertEquals(5600, $productOption->price);
        $this->assertEquals(56, $productOption->formatted_price);
    }

    /** @test */
    public function a_product_option_must_have_one_main_image()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Category::factory()->create();

        $this->followingRedirects()->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
            'categories' => [1],
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
        ])->assertSuccessful();

        $this->assertTrue(Product::first()->productOptions()->first()->images()->first()->is_main);
        $this->assertInstanceOf(ImageOption::class, Product::first()->productOptions()->first()->main_image);
    }

    /** @test */
    public function if_a_product_is_preorder_a_quantity_must_be_indicated_for_each_options()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Category::factory()->create();

        $this->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
            'is_preorder' => 1,
            'categories' => [1],
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
        ])->assertSessionHasErrors(['options.1.quantity']);

        $this->post(route('admin.products.store'), [
            'name' => 'Mon premier produit',
            'is_preorder' => 1,
            'categories' => [1],
            'options' => [
                1 => [
                    'quantity' => 40,
                    'name' => 'Option 1',
                    'sku' => '9999',
                    'price' => '45',
                    'description' => 'Option description',
                    'images' => [
                        UploadedFile::fake()->image('option_1.jpg'),
                    ],
                ]
            ],
        ]);

        $this->assertInstanceOf(PreOrderProductOptionQuantity::class, Product::first()->productOptions()->first()->preOrderStock()->first());
        $this->assertEquals(40, Product::first()->productOptions()->first()->preOrderStock()->first()->quantity);
    }
}
