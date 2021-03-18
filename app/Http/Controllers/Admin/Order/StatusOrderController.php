<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Repositories\Order\OrderRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatusOrderController extends Controller
{
    public function edit(Order $order): RedirectResponse|View
    {
        return view('admin.orders.status', [
            'order' => $order->load('status'),
            'status' => OrderStatus::orderChange()->get(),
        ]);
    }

    public function update(OrderRepository $orderRepository, Request $request,Order $order): RedirectResponse
    {
        $request->validate([
            'status' => [
                'required', 'exists:order_statuses,id',
            ]
        ]);

        try {
            $orderRepository->updateStatus($order, $request->get('status'));

            return redirect()->route('admin.orders.show', $order)->with([
                'type' => 'Succès',
                'message' => 'Le statut de la commande a bien été modifié, le client va recevoir un email.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
