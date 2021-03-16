<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;

class SavePaymentOrder implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        $event->order->payment()->create([
            'reference' => $event->paymentIntentId,
            'type' => Payment::CARD_TYPE,
            'amount' => $event->order->price,
        ]);
    }
}
