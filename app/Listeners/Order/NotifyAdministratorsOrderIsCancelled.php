<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdministratorsOrderIsCancelled implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        notify_administrators("Commande n°{$event->order->id} annulée.");
    }
}
