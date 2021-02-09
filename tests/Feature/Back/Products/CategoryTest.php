<?php

namespace Tests\Feature\Back\Products;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
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
        $this->withoutExceptionHandling();
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
}
