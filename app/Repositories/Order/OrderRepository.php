<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;

class OrderRepository
{
    public function cancel(Order $order): void
    {
        $order->update([
            'order_status_id' => OrderStatus::CANCELLED,
        ]);

        // todo cancel payment

        // todo notify user and admin
    }
}
