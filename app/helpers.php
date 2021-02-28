<?php

use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Models\User;
use App\Notifications\SimpleAdminNotification;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;

if (!function_exists('notify_administrators')) {
    function notify_administrators(string $eventType): void
    {
        Notification::send(
            User::administrators(),
            new SimpleAdminNotification($eventType)
        );
    }
}

if (!function_exists('get_cart_row_id')) {
    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    function get_cart_row_id(
        ProductOption|ProductOptionSize $productOption, 
        string $instance = "order", 
        ?int $sizeId = null
    ): string
    {
        if ($instance === 'preorder') {

            if (is_null($sizeId)) {
                throw new \Exception("Argument 'sizeId' cannot be null", 1);
            }

            return Cart::instance($instance)
                ->content()
                ->where('id', $productOption->id)
                ->whereIn('options.sizeId', $sizeId)
                ->first()
                ->rowId;
        }

        return Cart::instance('order')
            ->content()
            ->firstWhere('id', $productOption->id)
            ->rowId;
    }
}

if (!function_exists('get_cart_subtotal')) {
    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    function get_cart_subtotal(bool $formatted = false, string $instance = "order"): float
    {
        $total = Cart::instance($instance)->content()->sum(function (CartItem $cartItem) {
            return $cartItem->price * $cartItem->qty;
        });

        return $formatted ? $total / 100 : $total;
    }
}

if (!function_exists('cart_is_empty')) {
    /**
     * Check if a cart is empty
     * @psalm-suppress UndefinedDocblockClass
     */
    function cart_is_empty(string $instance): bool
    {
        return Cart::instance($instance)->content()->isEmpty();
    }
}

if (!function_exists('carts_are_empty')) {
    /**
     * Check if all carts are empty
     * @psalm-suppress UndefinedDocblockClass
     */
    function carts_are_empty(): bool
    {
        return Cart::instance('order')->content()->isEmpty() && Cart::instance('preorder')->content()->isEmpty();
    }
}
