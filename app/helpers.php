<?php

use App\Models\ProductOptionSize;
use App\Models\User;
use App\Notifications\SimpleAdminNotification;
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
    function get_cart_row_id(ProductOptionSize $productOptionSize): string
    {
        return Cart::content()->where('id', $productOptionSize->id)->first()->rowId;
    }
}
