<?php

namespace Tests\Feature\Back\Users;

use App\Models\User;
use Tests\TestCase;

class UserShowingTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_index_users_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.users.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.users.index')
            ->assertSee('Voir tous les clients');
    }

    /** @test */
    public function an_admin_can_see_a_user_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $client = User::factory()->create();

        $this->get(route('admin.users.show', $client))
            ->assertSuccessful()
            ->assertViewIs('admin.users.show')
            ->assertSee('Voir le client : ' . $client->full_name);
    }

    /** @test */
    public function an_admin_can_see_a_user_orders_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $client = User::factory()->create();

        $this->get(route('admin.users.orders', $client))
            ->assertSuccessful()
            ->assertViewIs('admin.users.orders')
            ->assertSee('Voir les commandes de : ' . $client->full_name);
    }
    
}
