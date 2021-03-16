<?php

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Services\StripeInteractorService;

class PaymentRepository
{
    public function refund(Order $order, int $amount): void
    {
        $stripeInteractorService = new StripeInteractorService;

        $stripeRefund = $stripeInteractorService->refund($order->payment->reference, $amount);

        $order->refund()->create([
            'user_id' => $order->user?->id,
            'reference' => $stripeRefund->id,
        ]);
    }
}
