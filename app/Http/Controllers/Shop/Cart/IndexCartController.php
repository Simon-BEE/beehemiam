<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;

class IndexCartController extends Controller
{
    public function __invoke(): View
    {
        return view('shop.cart.index', [
            'cart' => Cart::content(),
        ]);
    }
}
