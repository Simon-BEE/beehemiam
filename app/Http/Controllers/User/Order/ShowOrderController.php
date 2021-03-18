<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;

class ShowOrderController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('user.orders.index', [
            'orders' => $user->orders()->with('status')->simplePaginate(8),
        ]);
    }

    public function show(Order $order): View
    {
        $this->authorize('show', $order);

        return view('user.orders.show', [
            'order' => $order->load(['status', 'address', 'orderItems', 'payment']),
        ]);
    }
}
