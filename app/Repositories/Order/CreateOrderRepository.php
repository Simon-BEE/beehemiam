<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Repositories\Shop\Cart\CartRepository;
use App\Services\CartAmountService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CreateOrderRepository
{
    public function __construct(public CartAmountService $cartAmountService, public CartRepository $cartRepository)
    {
    }

    public function save(string $clientSecretKey): void
    {
        $this->verifyAddress();

        $order = $this->storeOrder();

        $this->storeOrderItems($order);

        $this->generateInvoice($order);

        $this->savePayment($order, $clientSecretKey);

        $this->cleanCart();

        clean_session_addresses();
    }

    private function storeOrderItems(Order $order): void
    {
        foreach ($this->cartRepository->getProductsFromCart() as $cartItem) {
            $cartItem = collect($cartItem);

            $order->orderItems()->create([
                'product_option_id' => $cartItem->get('product_option')['id'],
                'size_id' => $cartItem->get('size')['id'],
                'name' => $cartItem->get('product_option')['name'],
                'price' => $cartItem->get('product_option')['price'],
                'quantity' => $cartItem->get('cart_quantity'),
                'tax' => config('cart.tax'),
            ]);
        }
    }

    private function storeOrder(): Order
    {
        return Order::create([
            'order_status_id' => OrderStatus::PREPARATION,
            'user_id' => auth()->id(),
            'shipping_id' => $this->cartAmountService->getShipping()->id,
            'address_id' => get_client_shipping_address()->id,
            'price' => $this->cartAmountService->getTotalAmount(),
            'shipping_fees' => $this->cartAmountService->getShippingFeesAmount(),
            // todo preorder change
            'is_preorder' => false,
        ]);
    }

    public function generateInvoice($order): void
    {
        // todo: improve
        $order->invoice()->create([
            'address_id' => get_client_billing_address()->id,
            'reference' => mt_rand(1000, 99999),
            'full_path' => '//',
            'content' => 'HELLO',
        ]);
    }

    private function savePayment(Order $order, string $clientSecretKey): void
    {
        $order->payment()->create([
            'reference' => $clientSecretKey,
            'type' => Payment::CARD_TYPE,
            'amount' => $order->price,
        ]);
    }

    private function verifyAddress(): void
    {
        if (session('shipping_address')) {
            $address = tap(session('shipping_address'))->save();

            Session::put('shipping_address', $address);
        }

        if (session('billing_address')) {
            $address = tap(session('billing_address'))->save();

            Session::put('billing_address', $address);
        }
    }

    private function cleanCart(): void
    {
        Cart::instance('order')->destroy();
        Cart::instance('preorder')->destroy();

        $this->cleanCookieCart();
    }

    private function cleanCookieCart(): void
    {
        unset($_COOKIE['beehemiamCart']);
    }
}
