<?php

namespace App\Mail\Orders;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class OrderSummaryMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $verboseStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Order $order, public Collection $orderItems, public Address $address)
    {
        $this->verboseStatus = $order->has_preorder
            ? 'attente de fin de précommande avant de vous être expédiée'
            : 'en cours de préparation';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.summary')
            ->subject('Récapitulatif de la commande n°' . $this->order->id);
    }
}
