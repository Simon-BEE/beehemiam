<?php

namespace Tests\Feature\User;

use App\Models\Order;
use App\Models\Payment;
use Tests\TestCase;

class UserOrderTest extends TestCase
{
    /** @test */
    public function a_user_can_access_to_his_orders_page()
    {
        $this->signIn();

        $this->get(route('user.orders.index'))
            ->assertSuccessful()
            ->assertViewIs('user.orders.index');
    }

    /** @test */
    public function a_user_can_access_to_an_order_page_that_belongs_to_him()
    {
        $user = $this->signIn();
        $order = Order::factory()->create(['user_id' => $user->id]);
        Payment::factory()->create(['order_id' => $order->id]);

        $this->get(route('user.orders.show', $order))
            ->assertSuccessful()
            ->assertViewIs('user.orders.show');
    }

    /** @test */
    public function a_user_cannot_access_to_an_order_page_that_does_not_belong_to_him()
    {
        $this->signIn();
        $order = Order::factory()->create();

        $this->get(route('user.orders.show', $order))
            ->assertNotFound();
    }

    // /** @test */
    // public function a_guest_can_access_to_an_order_page_with_correct_encrypted_order_id_in_url()
    // {
    //     $order = Order::factory()->create(['user_id' => null]);

    //     $this->get(route('user.orders.show', $order))
    //         ->assertStatus(302);

    //     $this->get(route('guest.orders.show', $order->hashed_id))
    //         ->assertSuccessful()
    //         ->assertSee($order->formatted_price);
    // }
}
