<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;
use App\Mail\Orders\OrderCancelledMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOrderIsCancelled implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        Mail::to($event->order->email_contact)->send(new OrderCancelledMail($event->order));
    }
}
