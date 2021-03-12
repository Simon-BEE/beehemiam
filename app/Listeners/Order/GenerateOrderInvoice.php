<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateOrderInvoice implements ShouldQueue
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
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        // todo: improve
        $event->order->invoice()->create([
            'address_id' => get_client_billing_address()->id,
            'reference' => mt_rand(1000, 99999),
            'full_path' => '//',
            'content' => 'HELLO',
        ]);
    }
}
