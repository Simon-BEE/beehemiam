<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;

class RemoveCouponOrder
{
    /**
     * Handle the event.
     *
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        $event->order->coupons()->detach();
    }
}
