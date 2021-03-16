<?php

namespace App\Repositories\Order;

use App\Events\Order\NewOrderCancelledEvent;
use App\Models\Order;
use App\Models\OrderStatus;

class OrderRepository
{
    public function cancel(Order $order): void
    {
        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        event(new NewOrderCancelledEvent($order));

        // todo adjust quantity

        // todo notify user and admin
    }

    public function cancelTest(Order $order): void
    {
        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        event(new NewOrderCancelledEvent($order));

        $order->refund()->create([
            'user_id' => $order->user?->id,
            'reference' => 'refund-stripe-key',
        ]);
    }
}
