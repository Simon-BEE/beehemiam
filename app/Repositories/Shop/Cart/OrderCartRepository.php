<?php

namespace App\Repositories\Shop\Cart;

use App\Exceptions\Product\ProductQuantityException;
use App\Models\ProductOptionSize;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderCartRepository extends CartRepository
{
    public function add(ProductOptionSize $productOptionSize): void
    {
        if ($cartItem = $this->getIfExistsInCart($productOptionSize)) {
            /** @var CartItem $cartItem */
            $this->update($productOptionSize, $cartItem->qty + 1);

            return;
        }

        Cart::instance('order')->add(
            $productOptionSize->id,
            $productOptionSize->productOption->name,
            1,
            $productOptionSize->productOption->price
        );
    }

    public function update(ProductOptionSize $productOptionSize, float|int $quantity): void
    {
        if ($productOptionSize->quantity < Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty) {
            throw new ProductQuantityException("Plus de stock disponible", 1);
        }

        Cart::instance('order')->update(get_cart_row_id($productOptionSize), $quantity);
    }

    public function remove(ProductOptionSize $productOptionSize): void
    {
        Cart::instance('order')->remove(get_cart_row_id($productOptionSize));

        if (cart_is_empty('order')) {
            Cart::instance('order')->destroy();
        }
    }

    private function getIfExistsInCart(ProductOptionSize $productOptionSize): CartItem|bool
    {
        try {
            return Cart::instance('order')->get(get_cart_row_id($productOptionSize));
        } catch (\Exception $e) {
            return false;
        }
    }
}
