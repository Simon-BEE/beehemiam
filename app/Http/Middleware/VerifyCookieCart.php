<?php

namespace App\Http\Middleware;

use App\Models\ProductOptionSize;
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

        if (Cart::content()->isEmpty() && isset($cookies['beehemiamCart'])) {
            $productOptionSizes = $this->getProductOptionSizesFromCookies(json_decode($cookies['beehemiamCart']));

            foreach ($productOptionSizes as $productOptionSize) {
                Cart::add(
                    $productOptionSize->id,
                    $productOptionSize->productOption->name,
                    1,
                    $productOptionSize->productOption->price
                );
            }
        }
        
        return $response;
    }

    private function getProductOptionSizesFromCookies(array $rawProductOptionsSizesId): Collection
    {
        $productOptionSizeIds = $this->formatIds($rawProductOptionsSizesId);
        return ProductOptionSize::with('productOption:id,price,name')->find($productOptionSizeIds);
    }

    private function formatIds(array $rawProductOptionsSizesId): array
    {
        $formatted = [];

        foreach ($rawProductOptionsSizesId as $rawProductOptionsSizeId) {
            $formatted[] = $rawProductOptionsSizeId->productOptionSizeId;
        }
        
        return $formatted;
    }
}
