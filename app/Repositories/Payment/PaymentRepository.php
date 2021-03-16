<?php

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Services\StripeInteractorService;

class PaymentRepository
{
    public function refund(Order $order): void
    {
        $stripeInteractorService = new StripeInteractorService;

        $stripeRefund = $stripeInteractorService->refund($order);

        $refund = $order->refund()->create([
            'user_id' => $order->user?->id,
            'reference' => $stripeRefund->id,
        ]);
    }
}
