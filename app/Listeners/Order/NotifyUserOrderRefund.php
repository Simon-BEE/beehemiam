<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPartialRefundEvent;
use App\Mail\Orders\OrderRefundMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserOrderRefund implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderPartialRefundEvent  $event
     * @return void
     */
    public function handle(OrderPartialRefundEvent $event)
    {
        Mail::to($event->order->email_contact)->send(new OrderRefundMail($event->order, $event->amount));
    }
}
