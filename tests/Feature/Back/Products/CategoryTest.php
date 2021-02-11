<?php

namespace Tests\Feature\Back\Products;

use Amp\Producer;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_all_categories_already_created()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        Category::factory()->count(10)->create();

        $this->get(route('admin.categories.index'))
            ->assertSuccessful()
            ->assertSee(Category::inRandomOrder()->first()->name);
    }
    

    /** @test */
    public function an_admin_can_see_create_category_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.categories.create'))
            ->assertSuccessful()
            ->assertSee('Ajouter une nouvelle catégorie de vêtements');
    }
    
    /** @test */
    public function a_category_can_be_created()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->followingRedirects()->post(route('admin.categories.store'), [
            'name' => 'Nom de la catégorie',
            'description' => 'Description de la catégorie',
        ])->assertSuccessful();

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function an_admin_can_see_edit_category_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $category = Category::factory()->create();

        $this->get(route('admin.categories.edit', $category))
            ->assertSuccessful()
            ->assertSee('Editer la catégorie : ' . $category->name);
    }
    
    /** @test */
    public function a_category_can_be_edited()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $category = Category::factory()->create(['name' => 'Nom de la catégorie']);

        $this->followingRedirects()->patch(route('admin.categories.update', $category), [
            'name' => 'Nouveau nom de la catégorie',
            'description' => 'Description de la catégorie',
        ])->assertSuccessful();

        $this->assertEquals('Nouveau nom de la catégorie', $category->fresh()->name);
        $this->assertEquals('nouveau-nom-de-la-categorie', $category->fresh()->slug);
    }
    
    /** @test */
    public function a_category_can_be_deleted()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $category = Category::factory()->create();

        $this->followingRedirects()->delete(route('admin.categories.destroy', $category))
            ->assertSuccessful();

        $this->assertCount(0, Category::all());
    }
    
    /** @test */
    public function if_a_category_is_deleted_and_an_associated_product_had_only_this_category_attached_product_status_changes_to_inactive()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $category = Category::factory()->create();
        $product = Product::factory()->active()->create();
        $product->categories()->attach($category->id);

        $this->assertCount(1, $product->categories);

        $this->followingRedirects()->delete(route('admin.categories.destroy', $category))
            ->assertSuccessful();

        $this->assertCount(0, Category::all());
        $this->assertCount(0, $product->fresh()->categories);
        $this->assertFalse($product->fresh()->is_active);
    }
}
