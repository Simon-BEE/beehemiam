<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;
use App\Repositories\Payment\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefundTotalOrderAmount implements ShouldQueue
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
     * Refund in stripe and create refund entity in database
     *
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        $this->paymentRepository->refund($event->order, $event->order->price, $event->order->payment->type);
    }
}
