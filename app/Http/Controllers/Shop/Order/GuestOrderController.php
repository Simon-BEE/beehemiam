<?php

namespace App\Http\Controllers\Shop\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Vinkla\Hashids\Facades\Hashids;

class GuestOrderController extends Controller
{
    public function show(string $encodedHashedId): View
    {
        $order = Order::with(['status', 'address', 'orderItems', 'payment'])
            ->firstWhere('id', Hashids::decode($encodedHashedId)[0] ?? 0);

        if (is_null($order) || $order->user) {
            abort(404);
        }

        return view('guest.orders.show', [
            'order' => $order,
        ]);
    }

    public function invoice(string $encodedHashedId): BinaryFileResponse
    {
        $order = Order::with(['status', 'address', 'orderItems', 'payment'])
            ->firstWhere('id', Hashids::decode($encodedHashedId)[0] ?? 0);

        if (is_null($order) || $order->user) {
            abort(404);
        }

        return response()->file($order->invoice->file_path);
    }
}
