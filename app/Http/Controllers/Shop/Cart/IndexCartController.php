<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;

class IndexCartController extends Controller
{
    public function __invoke(CartRepository $repository): View
    {
        // dd((float)\Cart::subtotal(2, '.', '.') * 10, \Cart::content());
        return view('shop.cart.index', [
            'cart' => $repository->getProductsFromCart(),
            'subTotal' => (float)\Cart::subtotal(2, '.', '.') * 10,
        ]);
    }
}
