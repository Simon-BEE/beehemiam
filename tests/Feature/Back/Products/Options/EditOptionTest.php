<?php

namespace Tests\Feature\Back\Products\Options;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake();

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

        $this->followingRedirects()->patch(route('admin.products.options.update', [$product, $productOption]), [
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
        ])->assertSuccessful();

        $this->assertEquals('Option 1', $productOption->fresh()->name);
    }

    /** @test */
    public function a_product_option_pre_order_can_be_edited()
    {
        Storage::fake();

        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $product = Product::factory()->create([
            'name' => 'Nom de produit',
            'is_preorder' => 1,
        ]);
        $productOption = ProductOption::factory()->create([
            'product_id' => $product->id,
        ]);

        $this->followingRedirects()->patch(route('admin.products.options.update', [$product, $productOption]), [
            'name' => 'Option 1',
            'sku' => '9999',
            'price' => '45',
            'description' => 'Option description',
            'images' => [
                UploadedFile::fake()->image('option_1.jpg'),
            ],
            'quantity' => 40,
        ])->assertSuccessful();

        $this->assertEquals('Option 1', $productOption->fresh()->name);
    }
}
