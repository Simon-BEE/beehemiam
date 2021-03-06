<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;

class IndexCartController extends Controller
{
    public function __invoke(CartRepository $repository): View
    {
        return view('shop.cart.index', [
            'cart' => $repository->getProductsFromCart(),
            'subTotal' => get_cart_subtotal(true, 'order') + get_cart_subtotal(true, 'preorder'),
            'coupon' => session()->has('coupon')
                ? session('coupon')->get('coupon')->only(['code', 'amount'])
                : null,
        ]);
    }
}
