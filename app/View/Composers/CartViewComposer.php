<?php

namespace App\View\Composers;

use App\Models\Country;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;

class CartViewComposer
{
    public function __construct(private CartRepository $cartRepository)
    {
        //
    }

    public function compose(View $view): void
    {
        $view->with([
            // if cart contains normal products and preorder products
            'hasOrderAndPreOrder' => !cart_is_empty('order') && !cart_is_empty('preorder'),
            // all products carts (order + preorder)
            'cart' => $this->cartRepository->getProductsFromCart(),
            // total from carts
            'subTotal' => get_cart_subtotal(true, 'order') + get_cart_subtotal(true, 'preorder'),
            // coupon or null
            'coupon' => session()->has('coupon')
                ? session('coupon')->get('coupon')->only(['code', 'amount'])
                : null,
            // countries
            'countries' => Country::all(),
            // user or null
            'user' => auth()->user(),
        ]);
    }
}
