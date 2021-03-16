<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Payment\PaymentRepository;
use App\Services\StripeInteractorService;

class OrderRepository
{
    public function cancel(Order $order): void
    {
        $paymentRepository = new PaymentRepository;

        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        // todo cancel payment
        $paymentRepository->refund($order);

        // todo adjust quantity

        // todo notify user and admin
    }
}
