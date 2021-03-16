<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderCancelledEvent;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\ProductOptionSize;

class RestoreProductsQuantities
{
    /**
     * Handle the event.
     *
     * @param  NewOrderCancelledEvent  $event
     * @return void
     */
    public function handle(NewOrderCancelledEvent $event)
    {
        foreach ($event->order->orderItems as $orderItem) {
            if ($orderItem->is_preorder) {
                $productOption = PreOrderProductOptionQuantity::firstWhere('product_option_id', $orderItem->product_option_id);
            } else {
                $productOption = ProductOptionSize::where('size_id', $orderItem->size_id)
                    ->where('product_option_id', $orderItem->product_option_id)
                    ->first();
            }

            if (is_null($productOption)) {
                return;
            }

            $productOption->increment('quantity', $orderItem->quantity);
        }
    }
}
