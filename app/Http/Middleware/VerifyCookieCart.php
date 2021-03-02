<?php

namespace App\Http\Middleware;

use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Models\Size;
use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class VerifyCookieCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @psalm-suppress UndefinedDocblockClass
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        /** @var array $cookies */
        $cookies = filter_input_array(INPUT_COOKIE);

        if (carts_are_empty()
            && isset($cookies['beehemiamCart'])
            && $cookies['beehemiamCart'] !== "[]") {
            $rawCartItems = json_decode($cookies['beehemiamCart']);

            $productOptionSizes = $this->getProductOptionSizesFromCookies($rawCartItems);
            $productOptionPreOrders = $this->getProductOptionsWithSizes($rawCartItems);

            foreach ($productOptionSizes as $productOptionSize) {
                Cart::instance('order')->add(
                    $productOptionSize->id,
                    $productOptionSize->productOption->name,
                    1,
                    $productOptionSize->productOption->price
                );
            }

            foreach ($productOptionPreOrders as $productOptionSize) {
                Cart::instance('preorder')->add(
                    $productOptionSize->get('productOption')->id,
                    $productOptionSize->get('productOption')->name,
                    1,
                    $productOptionSize->get('productOption')->price,
                    [
                        'sizeId' => $productOptionSize->get('size')->id,
                        'sizeName' => $productOptionSize->get('size')->name,
                    ]
                );
            }
        }
        
        return $response;
    }

    private function getProductOptionSizesFromCookies(array $rawCartItems): Collection
    {
        $productOptionSizeIds = $this->formatProductOptionSizeIds($rawCartItems);
        return ProductOptionSize::with('productOption:id,price,name')->find($productOptionSizeIds);
    }

    private function getProductOptionsWithSizes(array $rawCartItems): Collection
    {
        $formatted = [];

        foreach ($rawCartItems as $rawCartItem) {
            if (property_exists($rawCartItem, 'preOrderStockId')) {
                $formatted[] = collect([
                    'productOption' => ProductOption::with('preOrderStock')
                        ->find($rawCartItem->preOrderStockId->productOptionId),
                    'size' => Size::find($rawCartItem->preOrderStockId->sizeId),
                ]);
            }
        }
        
        return collect($formatted);
    }

    private function formatProductOptionSizeIds(array $rawCartItems): array
    {
        $formatted = [];

        foreach ($rawCartItems as $rawCartItem) {
            if (property_exists($rawCartItem, 'productOptionSizeId')) {
                $formatted[] = $rawCartItem->productOptionSizeId;
            }
        }
        
        return $formatted;
    }
}
