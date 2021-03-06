<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreGuestAddressRequest;
use App\Models\Country;
use App\Repositories\Shop\Cart\AddressCartRepository;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AddressCartController extends Controller
{
    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    public function index(CartRepository $repository): RedirectResponse|View
    {
        if (carts_are_empty()) {
            return redirect()->route('shop.categories.index');
        }

        return view('shop.cart.shipping', [
            'cart' => $repository->getProductsFromCart(),
            'subTotal' => get_cart_subtotal(true, 'order') + get_cart_subtotal(true, 'preorder'),
            'coupon' => session()->has('coupon')
                ? session('coupon')->get('coupon')->only(['code', 'amount'])
                : null,
            'countries' => Country::all(),
            'user' => auth()->user(),
        ]);
    }

    public function store(AddressCartRepository $repository, StoreGuestAddressRequest $request): RedirectResponse
    {
        try {
            if (auth()->check()) {
                $repository->save($request->validated());
            } else {
                $repository->prepare($request->validated());
            }

            return redirect()->route('cart.shippings.index');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
