<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RefundOrderController extends Controller
{
    public function edit(Order $order): View
    {
        return view('admin.orders.refund', [
            'order' => $order->load(['orderItems']),
        ]);
    }

    public function update(OrderRepository $orderRepository, Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'amount' => [
                'required', 'numeric' ,'between:1,' . $order->formatted_total_with_refund,
            ]
        ]);

        try {
            $orderRepository->refund($order, unformat_amount($request->get('amount')));

            return redirect()->route('admin.orders.show', $order)->with([
                'type' => 'Succès',
                'message' => 'Le remboursement a bien eu lieu, le client va recevoir un email.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
