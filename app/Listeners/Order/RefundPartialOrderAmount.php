<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPartialRefundEvent;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefundPartialOrderAmount implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private PaymentRepository $paymentRepository)
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
        $this->paymentRepository->refund($event->order, $event->amount, $event->order->payment->type);
    }
}
