<?php

namespace App\Repositories\Order;

use App\Events\Order\NewOrderReceivedEvent;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\CartAmountService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CreateOrderRepository
{
    public function __construct(public CartAmountService $cartAmountService)
    {
    }

    public function save(string $clientSecretKey): Order
    {
        $this->verifyAddress();

        $order = Order::create([
            'order_status_id' => OrderStatus::PREPARATION,
            'user_id' => auth()->id(),
            'shipping_id' => $this->cartAmountService->getShipping()->id,
            'address_id' => get_client_shipping_address()->id,
            'price' => $this->cartAmountService->getTotalAmount(),
            'shipping_fees' => $this->cartAmountService->getShippingFeesAmount(),
            // todo preorder change
            'is_preorder' => false,
        ]);

        event(new NewOrderReceivedEvent($order, $clientSecretKey));

        $this->cleanSessions();

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

    private function cleanSessions(): void
    {
        Cart::instance('order')->destroy();
        Cart::instance('preorder')->destroy();

        clean_session_addresses();
    }
}
