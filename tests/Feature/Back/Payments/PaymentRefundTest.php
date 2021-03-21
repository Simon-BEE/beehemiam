<?php

namespace Tests\Feature\Back\Payments;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\User;
use Tests\TestCase;

class PaymentRefundTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_payments_and_refunds_page()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);

        $this->get(route('admin.transactions.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.transactions.index');
    }

    /** @test */
    public function an_admin_can_see_payment_show_page()
    {
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $payment = Payment::factory()->create();

        $this->get(route('admin.transactions.payments.show', $payment))
            ->assertSuccessful()
            ->assertViewIs('admin.transactions.show');
    }

    /** @test */
    public function an_admin_can_see_refund_show_page()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($admin);
        $order = Order::factory()->create();
        $order->payment()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);
        $refund = $order->refund()->create(['reference' => 'refernce-code', 'amount' => $order->price, 'type' => 'card']);

        $this->get(route('admin.transactions.refunds.show', $refund))
            ->assertSuccessful()
            ->assertViewIs('admin.transactions.show');
    }
}
