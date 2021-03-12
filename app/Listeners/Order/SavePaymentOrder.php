<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\Payment;

class SavePaymentOrder
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
        $event->order->payment()->create([
            'reference' => $event->clientSecretKey,
            'type' => Payment::CARD_TYPE,
            'amount' => $event->order->price,
        ]);
    }
}
