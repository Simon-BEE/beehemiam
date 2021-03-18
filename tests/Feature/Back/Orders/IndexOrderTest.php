<?php

namespace Tests\Feature\Back\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
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

    /** @test */
    public function an_admin_can_see_an_order_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();

        $this->get(route('admin.orders.show', $order))
            ->assertSuccessful()
            ->assertViewIs('admin.orders.show')
            ->assertSee('Commande n°' . $order->id);
    }

    /** @test */
    public function an_admin_can_see_change_order_status_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();

        $this->get(route('admin.orders.status.show', $order))
            ->assertSuccessful()
            ->assertViewIs('admin.orders.status')
            ->assertSee('Commande n°' . $order->id);
    }

    /** @test */
    public function an_admin_can_cancel_an_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();

        $this->followingRedirects()->delete(route('admin.orders.cancel', $order))
            ->assertSuccessful();

        $this->assertEquals(OrderStatus::CANCELLED, $order->fresh()->status->id);
    }

    /** @test */
    public function an_admin_cannot_cancel_a_completed_or_shipped_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create(['order_status_id' => OrderStatus::SHIPPING]);

        $this->followingRedirects()->delete(route('admin.orders.cancel', $order))
            ->assertForbidden();

        $this->assertEquals(OrderStatus::SHIPPING, $order->fresh()->status->id);
    }
}
