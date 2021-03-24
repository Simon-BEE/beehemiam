<?php

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Services\StripeInteractorService;
use Illuminate\Support\Facades\App;

class PaymentRepository
{
    private array $acceptedTypes = ['card'];

    public function refund(Order $order, int $amount, string $type = 'card'): void
    {
        if (!in_array($type, $this->acceptedTypes)) {
            throw new \Exception("Refund type $type cannot be accepted.", 1);
        }

        if ($amount > $order->price) {
            throw new \Exception("Amount too high. Max amount accepted: {$order->formatted_price}€", 1);
        }

        if ($order->price - $amount <= 0) {
            $order->cancel();
        }

        if (App::environment() === 'testing') {
            $this->refundTest($order, $amount, $type);
            return;
        }

        $stripeInteractorService = new StripeInteractorService;

        $stripeRefund = $stripeInteractorService->refund($order->payment->reference, $amount);

        $order->refunds()->create([
            'reference' => $stripeRefund->id,
            'amount' => $amount,
            'type' => $type,
        ]);
    }

    public function refundTest(Order $order, int $amount, string $type = 'card'): void
    {
        $order->refunds()->create([
            'reference' => 'refund-key',
            'amount' => $amount,
            'type' => $type,
        ]);
    }
}
