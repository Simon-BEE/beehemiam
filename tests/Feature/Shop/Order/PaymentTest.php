<?php

namespace Tests\Feature\Shop\Order;

use App\Models\Order;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /** @test */
    public function a_payment_can_be_refunded_within_15_minutes()
    {
        $user = $this->signIn();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->get(route('user.orders.show', $order))
            ->assertSee('Annuler ma commande');
    }

}
