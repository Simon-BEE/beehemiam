<?php

namespace App\Repositories\Shop\Cart;

use App\Exceptions\Product\ProductQuantityException;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\ProductOption;
use App\Models\Size;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class PreOrderCartRepository extends CartRepository
{
    public function add(ProductOption $productOption, Size $size): void
    {
        $this->resetFormattedCache();

        if ($cartItem = $this->getIfExistsInCart($productOption, $size)) {
            /** @var CartItem $cartItem */
            $this->update($productOption, $size, $cartItem->qty + 1);

            return;
        }

        Cart::instance('preorder')->add(
            $productOption->id,
            $productOption->name,
            1,
            $productOption->price,
            [
                'sizeId' => $size->id,
                'sizeName' => $size->name,
            ]
        );
    }

    public function update(ProductOption $productOption, Size $size, float|int $quantity): void
    {
        $this->resetFormattedCache();

        if (PreOrderProductOptionQuantity::select('quantity')
            ->firstWhere('product_option_id', $productOption->id)->quantity
            <= Cart::instance('order')->get(get_cart_row_id($productOption, 'preorder', $size->id))->qty
            && Cart::instance('order')->get(get_cart_row_id($productOption, 'preorder', $size->id))->qty < $quantity) {
            throw new ProductQuantityException("Plus de stock disponible", 1);
        }

        Cart::instance('preorder')
            ->update(get_cart_row_id($productOption, 'preorder', $size->id), $quantity);

        $this->checkCouponSession();
    }

    public function remove(ProductOption $productOption, Size $size): void
    {
        $this->resetFormattedCache();

        Cart::instance('preorder')
            ->remove(get_cart_row_id($productOption, 'preorder', $size->id));

        $this->checkCouponSession();

        if (cart_is_empty('preorder')) {
            Cart::instance('preorder')->destroy();
        }
    }

    private function getIfExistsInCart(ProductOption $productOption, Size $size): CartItem|bool
    {
        try {
            return Cart::instance('preorder')->get(get_cart_row_id($productOption, 'preorder', $size->id));
        } catch (\Exception $e) {
            return false;
        }
    }
}
