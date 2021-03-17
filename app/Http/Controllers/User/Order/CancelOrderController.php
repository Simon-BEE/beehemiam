<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use Illuminate\Http\RedirectResponse;

class CancelOrderController extends Controller
{
    public function __invoke(OrderRepository $repository, Order $order): RedirectResponse
    {
        if (!$order->created_at->betweenIncluded(now(), now()->subMinutes(15))) {
            logger(auth()->id() . " - Vous ne pouvez pas annuler cette commande.");
            abort(403, "Vous ne pouvez pas annuler cette commande.");
        }

        try {
            $repository->cancel($order);

            return redirect()->route('user.orders.index')->with([
                'type' => 'Succès',
                'message' => 'Votre commande a bien été annulée. Vous allez recevoir un email vous le confirmant.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
