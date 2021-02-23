<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
            foreach (json_decode($cookies['beehemiamCart']) as $cart) {
                Cart::add($cart->productOptionSizeId, 'NONAME', 1, 1);
            }
        }
        
        return $response;
    }
}
