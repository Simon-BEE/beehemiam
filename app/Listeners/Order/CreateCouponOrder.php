<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;

class CreateCouponOrder
{
    /**
     * Handle the event.
     *
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        if (is_null($event->coupon)) {
            return;
        }
        $event->order->coupons()->attach(
            $event->coupon->get('coupon')->id,
        );
    }
}
