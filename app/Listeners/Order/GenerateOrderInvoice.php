<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Services\InvoiceGeneratorService;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateOrderInvoice implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  NewOrderReceivedEvent  $event
     * @return void
     */
    public function handle(NewOrderReceivedEvent $event)
    {
        $invoiceGenerator = new InvoiceGeneratorService($event->order, $event->billingAddress);

        if (!\App::environment('testing')) {
            $invoiceGenerator->generate()->save();
        }

        $event->order->invoice()->create([
            'address_id' => $event->billingAddress->id,
            'reference' => $invoiceGenerator->invoiceReference,
            'filename' => $invoiceGenerator->pdfName,
        ]);
    }
}
