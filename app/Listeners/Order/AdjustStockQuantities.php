<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\ProductOptionSize;
use App\Repositories\Shop\Cart\CartRepository;

class AdjustStockQuantities
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public CartRepository $cartRepository)
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
        foreach ($this->cartRepository->getProductsFromCart() as $cartItem) {
            $cartItem = collect($cartItem);

            if ($cartItem->get('is_preorder')) {
                $productOptionQuantity = PreOrderProductOptionQuantity::find($cartItem->get('product_option')['id']);
            } else {
                $productOptionQuantity = ProductOptionSize::where('size_id', $cartItem->get('size')['id'])
                    ->where('product_option_id', $cartItem->get('product_option')['id'])
                    ->first();
            }

            $productOptionQuantity->decrement('quantity', $cartItem->get('cart_quantity'));
        }
    }
}
