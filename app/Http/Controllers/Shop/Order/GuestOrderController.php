<?php

namespace App\Http\Controllers\Shop\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Vinkla\Hashids\Facades\Hashids;

class GuestOrderController extends Controller
{
    public function __invoke(string $encodedHashedId): View
    {
        $order = Order::with(['status', 'address', 'orderItems', 'payment'])
            ->firstWhere('id', Hashids::decode($encodedHashedId));

        if (is_null($order) || $order->user) {
            abort(404);
        }

        return view('guest.orders.show', [
            'order' => $order,
        ]);
    }
}
