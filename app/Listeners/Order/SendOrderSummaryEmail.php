<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Mail\Orders\OrderSummaryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderSummaryEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        $email = $event->order->user
            ? $event->order->user->email
            : $event->order->address->email;

        Mail::to($email)->send(new OrderSummaryMail($event->order, $event->order->orderItems, $event->order->address));
    }
}
