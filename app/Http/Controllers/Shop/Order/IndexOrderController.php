<?php

namespace App\Http\Controllers\Shop\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IndexOrderController extends Controller
{
    public function __invoke(CartRepository $cartRepository): RedirectResponse|View
    {
        if (carts_are_empty()
            || (!auth()->check() && !session()->has('billing_address'))
            || (auth()->check() && is_null(auth()->user()->address))
        ) {
            return redirect('/')->with([
                'type' => 'Erreur',
                'message' => 'Vous ne pouvez pas passer en commande.',
            ]);
        }

        $cartRepository->resetFormattedCache();

        $user = auth()->user();

        return view('shop.cart.orders.index', [
            'contactEmail' => session()->has('billing_address')
                ? session('billing_address')->email
                : $user->email,
            'shippingAddress' => session('shipping_address') ?? session('billing_address') ?? $user->address,
            'billingAddress' => session('billing_address') ?? $user->billing_address,
            'estimatedShippingDate' => now()->addWeekdays(5)->diffForHumans(),
        ]);
    }
}
