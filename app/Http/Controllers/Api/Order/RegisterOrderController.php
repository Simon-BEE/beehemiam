<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Order\CreateOrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterOrderController extends Controller
{
    public function __invoke(CreateOrderRepository $repository, Request $request): JsonResponse
    {
        $request->validate(['payment_intent' => [
            'required', 'string',
        ]]);

        try {
            $order = $repository->save($request->get('payment_intent'));

            return response()->json([
                'success' => true,
                'order_link' => $order->path,
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'message' => 'Erreur du serveur',
            ], 500);
        }
    }
}
