<?php

namespace Tests\Feature\Back\Orders;

use App\Mail\Orders\OrderRefundMail;
use App\Mail\Orders\OrderStatusUpdatedMail;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Notifications\SimpleAdminNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

    /** @test */
    public function client_is_notified_when_an_admin_update_his_order_status()
    {
        Mail::fake();

        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->followingRedirects()->patch(route('admin.orders.status.update', $order), [
            'status' => OrderStatus::PREPARATION,
        ]);

        Mail::assertQueued(OrderStatusUpdatedMail::class);
    }

    /** @test */
    public function an_admin_can_see_refund_form_for_client_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->followingRedirects()->get(route('admin.orders.refund.edit', $order))
            ->assertSuccessful()
            ->assertViewIs('admin.orders.refund');
    }

    /** @test */
    public function an_admin_can_refund_a_client_order()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->assertDatabaseCount('refunds', 0);

        $this->followingRedirects()->patch(route('admin.orders.refund.update', $order), [
            'amount' => $order->formatted_price,
            ])
            ->assertSuccessful();

        $this->assertDatabaseCount('refunds', 1);
    }

    /** @test */
    public function when_an_order_is_refund_notifications_was_sent()
    {
        $this->withoutExceptionHandling();
        Notification::fake();
        Mail::fake();

        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->followingRedirects()->patch(route('admin.orders.refund.update', $order), [
            'amount' => $order->formatted_price,
            ])
            ->assertSuccessful();

        Notification::assertSentTo(User::administrators()->get(), SimpleAdminNotification::class);
        Mail::assertQueued(OrderRefundMail::class);
    }
}
