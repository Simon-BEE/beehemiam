<?php

namespace App\Repositories\Shop\Cart;

use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CartRepository
{
    public function getProductsFromCart(): array
    {
        if (carts_are_empty()) {
            return [];
        }

        $productsFromCart = Cache::rememberForever('beehemiamFormattedCart', function () {
            $productOptionSizes = $this->getProductOptionsSizesFormatted();
            $productOptionPreOrders = $this->getProductOptionsPreOrdersFormatted();

            return array_values($productOptionSizes->merge($productOptionPreOrders)->toArray());
        });

        /** @var array $productsFromCart */
        return $productsFromCart;
    }

    public function resetFormattedCache(): void
    {
        Cache::forget('beehemiamFormattedCart');
    }

    /**
     * Get productOptionsSizes with productOption, product, images and format.
     * And transform to a Collection with a property cart_quantity
     *
     * @psalm-suppress UndefinedDocblockClass
     *
     * @return Collection
     */
    private function getProductOptionsSizesFormatted(): Collection
    {
        if (cart_is_empty('order')) {
            return collect();
        }

        $productOptionSizes = $this->getProductOptionsSizes();

        $productOptionSizes->each(function (ProductOptionSize $productOptionSize) {
            $this->adjustQuantityAvailableForProductOptionSize($productOptionSize);
        });

        return $productOptionSizes->map(function (ProductOptionSize $productOptionSize) {
            return collect($productOptionSize)
                ->put('cart_quantity', Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty)
                ->put('is_preorder', false);
        });
    }

    private function getProductOptionsSizes(): Collection
    {
        return ProductOptionSize::with([
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
    }

    /**
     * Create Collection with (productOptions with preOrderStock, product, images and format) and size.
     * And format to match with productOptionsSizes results
     *
     * @psalm-suppress UndefinedDocblockClass
     *
     * @return Collection
     */
    private function getProductOptionsPreOrdersFormatted(): Collection
    {
        if (cart_is_empty('preorder')) {
            return collect();
        }

        $productOptions = $this->getProductOptionsPreOrders();

        $productOptions->each(function ($productOptionSize) {
            $this->adjustQuantityAvailableForProductOptionPreOrder($productOptionSize);
        });

        return $productOptions->map(function (Collection $productOption) {
            return collect([
                'product_option' => $productOption->get('productOption'),
                'size' => collect([
                    'id' => $productOption->get('size')->sizeId,
                    'name' => $productOption->get('size')->sizeName,
                ]),
                'cart_quantity' => Cart::instance('preorder')
                    ->get(get_cart_row_id(
                        $productOption->get('productOption'),
                        'preorder',
                        $productOption->get('size')->sizeId
                    ))
                    ->qty,
                'is_preorder' => true,
            ]);
        });
    }

    private function getProductOptionsPreOrders(): Collection
    {
        return Cart::instance('preorder')->content()->map(function (CartItem $cartItem) {
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
                    ->with(['preOrderStock:id,product_option_id,quantity'])
                    ->find($cartItem->id),
                    'size' => $cartItem->options,
                ]);
        });
    }

    /**
     * Adjust if necessary quantity in cart if product stock availibity is not enough
     *
     * @param ProductOptionSize $productOptionSize
     * @return void
     */
    private function adjustQuantityAvailableForProductOptionSize(ProductOptionSize $productOptionSize): void
    {
        if ($productOptionSize->quantity < Cart::instance('order')->get(get_cart_row_id($productOptionSize))->qty) {
            Cart::instance('order')->update(get_cart_row_id($productOptionSize), 1);
        }
    }

    /**
     * Adjust if necessary quantity in cart if product stock availibity is not enough
     *
     * @param Collection $productOption
     * @return void
     */
    private function adjustQuantityAvailableForProductOptionPreOrder(Collection $productOption): void
    {
        if ($productOption->get('productOption')->preOrderStock->quantity
            < Cart::instance('preorder')->get(get_cart_row_id(
                $productOption->get('productOption'),
                'preorder',
                $productOption->get('size')->sizeId
            ))->qty
            ) {
            Cart::instance('preorder')->update(get_cart_row_id(
                $productOption->get('productOption'),
                'preorder',
                $productOption->get('size')->sizeId
            ), 1);
        }
    }
}
