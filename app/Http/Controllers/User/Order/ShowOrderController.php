<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function invoice(Order $order): BinaryFileResponse
    {
        $this->authorize('show', $order);

        return response()->file($order->invoice->file_path);
    }

    public function refund(Order $order, Refund $refund): BinaryFileResponse
    {
        $this->authorize('show', $order);

        return response()->file($refund->file_path);
    }
}
