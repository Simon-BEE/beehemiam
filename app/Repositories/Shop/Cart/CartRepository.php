<?php

namespace App\Repositories\Shop\Cart;

use App\Models\ProductOptionSize;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepository
{
    public function add(ProductOptionSize $productOptionSize): void
    {
        if ($cartItem = $this->getIfExistsInCart($productOptionSize)) {
            /** @var CartItem $cartItem */
            $this->update($productOptionSize, $cartItem->qty + 1);

            return;
        }

        Cart::add(
            $productOptionSize->id,
            $productOptionSize->productOption->name,
            1,
            $productOptionSize->productOption->price
        );
    }

    public function update(ProductOptionSize $productOptionSize, float|int $quantity): void
    {
        Cart::update(get_cart_row_id($productOptionSize), $quantity);
    }

    private function getIfExistsInCart(ProductOptionSize $productOptionSize): CartItem|bool
    {
        try {
            return Cart::get(get_cart_row_id($productOptionSize));
        } catch (\Exception $e) {
            return false;
        }
    }
}