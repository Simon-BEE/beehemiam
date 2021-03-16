<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Payment\PaymentRepository;

class OrderRepository
{
    public function cancel(Order $order): void
    {
        $paymentRepository = new PaymentRepository;

        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        $paymentRepository->refund($order, $order->price);

        // todo adjust quantity

        // todo notify user and admin
    }

    public function cancelTest(Order $order): void
    {
        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        $order->refund()->create([
            'user_id' => $order->user?->id,
            'reference' => 'refund-stripe-key',
        ]);
    }
}
