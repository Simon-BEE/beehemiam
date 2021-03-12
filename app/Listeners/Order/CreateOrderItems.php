<?php

namespace App\Listeners\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Repositories\Shop\Cart\CartRepository;

class CreateOrderItems
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

            $event->order->orderItems()->create([
                'product_option_id' => $cartItem->get('product_option')['id'],
                'size_id' => $cartItem->get('size')['id'],
                'name' => $cartItem->get('product_option')['name'],
                'price' => $cartItem->get('product_option')['price'],
                'quantity' => $cartItem->get('cart_quantity'),
                'tax' => config('cart.tax'),
            ]);
        }
    }
}
