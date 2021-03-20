<?php

namespace App\Events\Order;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewOrderReceivedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Order $order;
    public string $paymentIntentId;
    public Address $billingAddress;
    public ?Collection $coupon = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Order $order,
        string $paymentIntentId,
        Address $billingAddress,
        ?Collection $coupon = null,
    ) {
        $this->order = $order;
        $this->paymentIntentId = $paymentIntentId;
        $this->billingAddress = $billingAddress;
        $this->coupon = $coupon;
    }
}
