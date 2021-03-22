<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderHasStatusUpdated;
use App\Mail\Order\OrderStatusUpdatedMail;
use App\Models\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOrderUpdated implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderHasStatusUpdated  $event
     * @return void
     */
    public function handle(OrderHasStatusUpdated $event)
    {
        if ($event->order->status->id !== OrderStatus::CANCELLED
            || $event->order->status->id !== OrderStatus::REFUNDED) {
            Mail::to($event->order->email_contact)->send(new OrderStatusUpdatedMail($event->order));
        }
    }
}
