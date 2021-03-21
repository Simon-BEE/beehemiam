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
    }

    public function updateStatus(Order $order, int $statusId): void
    {
        $acceptedStatus = OrderStatus::orderChange()->get();

        if (!$acceptedStatus->contains('id', $statusId)) {
            throw new \Exception("Impossible de modifier le statut de la commande.", 1);
        }

        $order->update([
            'order_status_id' => $statusId,
        ]);

        // todo event (notify user, ...)
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
            'amount' => $order->price,
        ]);
    }
}
