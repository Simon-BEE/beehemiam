<?php

namespace App\Repositories\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Shop\Cart\CartRepository;
use App\Services\CartAmountService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CreateOrderRepository
{
    public function __construct(public CartAmountService $cartAmountService)
    {
    }

    public function save(string $paymentIntentId): Order
    {
        $this->verifyAddress();

        $order = Order::create([
            'order_status_id' => OrderStatus::PREPARATION,
            'user_id' => auth()->id(),
            'shipping_id' => $this->cartAmountService->getShipping()->id,
            'address_id' => get_client_shipping_address()->id,
            'price' => $this->cartAmountService->getTotalAmount(),
            'shipping_fees' => $this->cartAmountService->getShippingFeesAmount(),
            'tax' => config('cart.tax'),
            'has_preorder' => Cart::instance('preorder')->content()->isNotEmpty(),
        ]);

        event(new NewOrderReceivedEvent($order, $paymentIntentId));

        $this->cleanCacheAndSessions();

        return $order;
    }

    private function verifyAddress(): void
    {
        if (session('shipping_address')) {
            /** @var Address $address */
            $address = session('shipping_address');
            $address = tap($address)->save();

            Session::put('shipping_address', $address);
        }

        if (session('billing_address')) {
            /** @var Address $address */
            $address = session('billing_address');
            $address = tap($address)->save();

            Session::put('billing_address', $address);
        }
    }

    private function cleanCacheAndSessions(): void
    {
        Cart::instance('order')->destroy();
        Cart::instance('preorder')->destroy();

        clean_session_addresses();

        (new CartRepository)->resetFormattedCache();
    }
}
