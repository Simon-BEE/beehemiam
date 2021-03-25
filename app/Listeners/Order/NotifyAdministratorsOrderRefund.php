<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPartialRefundEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdministratorsOrderRefund implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  OrderPartialRefundEvent  $event
     * @return void
     */
    public function handle(OrderPartialRefundEvent $event)
    {
        $formattedAmount = format_amount($event->amount);

        notify_administrators("Commande n°{$event->order->id} remboursée d'un montant de {$formattedAmount}€.");
    }
}
