<?php

namespace Tests\Feature\Back\Orders;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class IndexOrderTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_index_page_of_orders()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        Order::factory()->count(10)->create();

        $this->get(route('admin.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.orders.index')
            ->assertSee('Voir toutes les commandes')
            ->assertSee(Order::inRandomOrder()->first()->id)
        ;
    }
}
