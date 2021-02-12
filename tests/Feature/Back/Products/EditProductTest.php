<?php

namespace Tests\Feature\Back\Products;

use App\Exceptions\ProductActiveStatusException;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

   /** @test */
   public function a_product_can_be_edited_simply()
   {
       $this->withoutExceptionHandling();
       $user = User::factory()->create([
           'role' => User::ADMIN_ROLE,
       ]);
       $this->signIn($user);
       $category = Category::factory()->create();
       $product = Product::factory()->create([
           'name' => 'Nom de produit',
       ]);
       $product->categories()->attach($category->id);
       
        $this->followingRedirects()->patch(route('admin.products.update', $product), [
            'name' => 'Nouveau nom de produit',
            'categories' => [$category->id],
        ])
            ->assertSuccessful();

        $this->assertEquals('Nouveau nom de produit', $product->fresh()->name);
   }

   /** @test */
   public function a_product_can_be_edited_with_a_new_option()
   {
       Storage::fake();

       $user = User::factory()->create([
           'role' => User::ADMIN_ROLE,
       ]);
       $this->signIn($user);
       $category = Category::factory()->create();
       $product = Product::factory()->create([
           'name' => 'Nom de produit',
       ]);
       $product->categories()->attach($category->id);

       $this->assertCount(0, $product->productOptions);
       
        $this->followingRedirects()->patch(route('admin.products.update', $product), [
            'name' => 'Nouveau nom de produit',
            'categories' => [$category->id],
            'options' => [
                1 => [
                    'name' => 'Option 1',
                    'sku' => '9999',
                    'price' => '45',
                    'description' => 'Option description',
                    'images' => [
                        UploadedFile::fake()->image('option_1.jpg'),
                    ],
                    'sizes' => [
                        [
                            'id' => 1,
                            'quantity' => 15,
                        ],
                        [
                            'id' => 2,
                            'quantity' => 10,
                        ],
                        [
                            'id' => 4,
                            'quantity' => 20,
                        ],
                    ],
                ]
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals('Nouveau nom de produit', $product->fresh()->name);
        $this->assertCount(1, $product->fresh()->productOptions);
        $this->assertCount(2, $product->fresh()->productOptions->first()->images);
        $this->assertCount(3, $product->fresh()->productOptions->first()->sizes);
   }

   /** @test */
   public function a_product_can_be_edited_and_set_preorder()
   {
       Storage::fake();

       $user = User::factory()->create([
           'role' => User::ADMIN_ROLE,
       ]);
       $this->signIn($user);
       $category = Category::factory()->create();
       $product = Product::factory()->create([
           'name' => 'Nom de produit',
           'is_preorder' => false,
       ]);
       $product->categories()->attach($category->id);

       $this->assertCount(0, $product->productOptions);
       
       $this->patch(route('admin.products.update', $product), [
           'name' => 'Nouveau nom de produit',
           'categories' => [$category->id],
           'is_preorder' => true,
        ])
           ->assertSessionHasErrors(['options']);
       
        $this->followingRedirects()->patch(route('admin.products.update', $product), [
            'name' => 'Nouveau nom de produit',
            'categories' => [$category->id],
            'is_preorder' => true,
            'options' => [
                1 => [
                    'name' => 'Option 1',
                    'sku' => '9999',
                    'price' => '45',
                    'description' => 'Option description',
                    'images' => [
                        UploadedFile::fake()->image('option_1.jpg'),
                    ],
                    'quantity' => 30,
                ]
            ],
        ])
            ->assertSuccessful();

        $this->assertEquals('Nouveau nom de produit', $product->fresh()->name);
        $this->assertCount(1, $product->fresh()->productOptions);
        $this->assertCount(2, $product->fresh()->productOptions->first()->images);
        $this->assertEquals(30, $product->fresh()->productOptions->first()->preOrderStock->quantity);
   }

   /** @test */
   public function a_product_cannot_be_edited_if_it_set_as_active_without_quantity_in_product_options()
   {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Nom de produit',
            'is_active' => false,
        ]);
        $product->categories()->attach($category->id);
        ProductOption::factory()->create(['product_id' => $product->id]);

        $this->patch(route('admin.products.update', $product), [
            'name' => 'Nouveau nom de produit',
            'categories' => [$category->id],
            'is_active' => true,
        ])->assertSessionHas('type', 'Erreur');
   }
   
}
