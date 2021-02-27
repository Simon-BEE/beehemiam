<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Repositories\Shop\Cart\CartRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AddressCartController extends Controller
{
    public function __invoke(CartRepository $repository): RedirectResponse|View
    {
        if (Cart::content()->isEmpty()) {
            return redirect()->route('shop.categories.index');
        }

        return view('shop.cart.shipping', [
            'cart' => $repository->getProductsFromCart(),
            'subTotal' => get_cart_subtotal(true),
            'coupon' => session()->has('coupon')
                ? session('coupon')->get('coupon')->only(['code', 'amount'])
                : null,
            'countries' => Country::all(),
        ]);
    }
}
