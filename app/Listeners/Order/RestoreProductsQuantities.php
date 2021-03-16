<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RestoreProductsQuantities
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
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        //
    }
}
