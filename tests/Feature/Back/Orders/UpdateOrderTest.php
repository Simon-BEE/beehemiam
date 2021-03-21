<?php

namespace Tests\Feature\Back\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Tests\TestCase;

class UpdateOrderTest extends TestCase
{
    /** @test */
    public function an_admin_can_cancel_an_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

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

    /** @test */
    public function an_admin_can_update_status_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->followingRedirects()->patch(route('admin.orders.status.update', $order), [
            'status' => OrderStatus::PREPARATION,
        ])
            ->assertSuccessful();

        $this->assertEquals(OrderStatus::PREPARATION, $order->fresh()->status->id);
    }
}
