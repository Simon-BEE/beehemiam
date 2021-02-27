<?php

namespace App\Repositories\Shop\Cart;

use App\Models\ProductOptionSize;
use Exception;
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

    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    public function remove(ProductOptionSize $productOptionSize): void
    {
        Cart::remove(get_cart_row_id($productOptionSize));

        if (Cart::content()->isEmpty()) {
            Cart::destroy();
        }
    }

    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    public function getProductsFromCart(): array
    {
        if (Cart::content()->isEmpty()) {
            return [];
        }

        $productOptionSizes = ProductOptionSize::with([
            'productOption' => function ($query) {
                $query
                ->with(['product' => function ($query) {
                    $query->select(['id', 'name', 'slug'])
                        ->with(['categories' => function ($query) {
                            $query->select('id', 'name', 'slug');
                        }]);
                }])
                ->with(['images' => function ($query) {
                    $query->where('is_thumb', true)
                        ->select(['id', 'product_option_id','full_path', 'filename']);
                }])
                ->select('id', 'product_id', 'name', 'price')
                ;
            }
        ])
            ->with(['size'])
            ->find(Cart::content()->pluck('id')->toArray())
            ->makeHidden(['created_at', 'updated_at', 'quantity', 'size_id', 'product_option_id']);

        return $productOptionSizes->map(function (ProductOptionSize $productOptionSize) {
            return collect($productOptionSize)
                ->put('cart_quantity', Cart::get(get_cart_row_id($productOptionSize))->qty);
        })->toArray();
    }

    private function getIfExistsInCart(ProductOptionSize $productOptionSize): CartItem|bool
    {
        try {
            return Cart::get(get_cart_row_id($productOptionSize));
        } catch (Exception $e) {
            return false;
        }
    }
}
