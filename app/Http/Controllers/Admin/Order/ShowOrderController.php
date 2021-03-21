<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShowOrderController extends Controller
{
    public function show(Order $order, ?string $notification = null): View
    {
        if (!is_null($notification)) {
            $notification = request()->user()->notifications()->findOrFail($notification);

            $notification->markAsRead();
        }

        return view('admin.orders.show', [
            'order' => $order->load(['status', 'address.country', 'orderItems', 'payment', 'invoice']),
        ]);
    }

    public function cancel(OrderRepository $orderRepository, Order $order): RedirectResponse
    {
        if (!$order->is_in_progress || $order->is_shipped) {
            abort(403);
        }

        try {
            $orderRepository->cancel($order);

            return redirect()->route('admin.orders.show', $order)->with([
                'type' => 'Succès',
                'message' => 'La commande a bien été annulée, un email a été envoyé au client.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
