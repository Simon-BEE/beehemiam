<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPartialRefundEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateRefundCredit
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPartialRefundEvent  $event
     * @return void
     */
    public function handle(OrderPartialRefundEvent $event)
    {
        //
    }
}
