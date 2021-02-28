<?php

namespace App\Repositories\Shop\Cart;

use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;

class CartRepository
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
        Cart::instance('order')->update(get_cart_row_id($productOptionSize), $quantity);
    }

    public function remove(ProductOptionSize $productOptionSize): void
    {
        Cart::instance('order')->remove(get_cart_row_id($productOptionSize));

        if (cart_is_empty('order')) {
            Cart::instance('order')->destroy();
        }
    }

    public function getProductsFromCart(): array
    {
        if (cart_is_empty('order') || cart_is_empty('preorder')) {
            return [];
        }

        $productOptionSizes = $this->getProductOptionsSizes();
        $productOptionPreOrders = $this->getProductOptionsPreOrders();

        // dd($productOptionSizes, $productOptionPreOrders, array_values($productOptionSizes->merge($productOptionPreOrders)->toArray()));
        return array_values($productOptionSizes->merge($productOptionPreOrders)->toArray());
    }

    private function getIfExistsInCart(ProductOptionSize $productOptionSize): CartItem|bool
    {
        try {
            return Cart::instance('order')->get(get_cart_row_id($productOptionSize));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get productOptionsSizes with productOption, product, images and format.
     * And transform to a Collection with a property cart_quantity
     *
     * @return Collection
     */
    private function getProductOptionsSizes(): Collection
    {
        if (cart_is_empty('order')) {
            return collect();
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
            ->find(Cart::instance('order')->content()->pluck('id')->toArray())
            ->makeHidden(['created_at', 'updated_at', 'quantity', 'size_id', 'product_option_id']);

        return $productOptionSizes->map(function (ProductOptionSize $productOptionSize) {
            return collect($productOptionSize)
                ->put('cart_quantity', Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty);
        });
    }

    /**
     * Create Collection with (productOptions with preOrderStock, product, images and format) and size.
     * And format to match with productOptionsSizes results
     *
     * @return Collection
     */
    private function getProductOptionsPreOrders(): Collection
    {
        if (cart_is_empty('preorder')) {
            return collect();
        }

        $productOptions = Cart::instance('preorder')->content()->map(function (CartItem $cartItem) {
            return collect([
                    'productOption' => ProductOption::with(['product' => function ($query) {
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
                    ->with(['preOrderStock:id,product_option_id'])
                    ->find($cartItem->id),
                    'size' => $cartItem->options,
                ]);
        });

        return $productOptions->map(function (Collection $productOption) {

            return collect([
                'product_option' => $productOption->get('productOption'),
                'size' => collect([
                    'id' => $productOption->get('size')->sizeId,
                    'name' => $productOption->get('size')->sizeName,
                ]),
                'cart_quantity' => Cart::instance('preorder')
                    ->get(get_cart_row_id($productOption->get('productOption'), 'preorder'))
                    ->qty,
            ]);
        });
    }
}
