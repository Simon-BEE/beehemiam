<?php

namespace Tests\Feature\Back\Notifications;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Order\NewOrderNotification;
use Tests\TestCase;

class ReadNotificationTest extends TestCase
{
    /** @test */
    public function an_admin_can_read_a_notification_only()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $user->notify(new NewOrderNotification(Order::factory()->create()));

        $this->assertCount(1, $user->unreadNotifications);

        $this->followingRedirects()->get(route('admin.notifications.read', $user->notifications->first()))
            ->assertSuccessful();

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }

    /** @test */
    public function an_admin_can_read_a_notification_and_continue_to_order_page()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $order = Order::factory()->create();

        $user->notify(new NewOrderNotification($order));

        $this->assertCount(1, $user->unreadNotifications);

        $this->get(route('admin.orders.show', [$order, $user->notifications->first()]))
            ->assertSuccessful();

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }

}
