<?php

namespace App\Http\Controllers\Shop\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestAddressRequest;
use App\Models\Country;
use App\Repositories\Shop\Cart\AddressCartRepository;
use App\Repositories\Shop\Cart\CartRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AddressCartController extends Controller
{
    /**
     * @psalm-suppress UndefinedDocblockClass
     */
    public function index(CartRepository $repository): RedirectResponse|View
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

    public function store(AddressCartRepository $repository, StoreGuestAddressRequest $request): RedirectResponse
    {
        try {
            $repository->prepare($request->validated());

            return redirect()->route('cart.shippings.index');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
