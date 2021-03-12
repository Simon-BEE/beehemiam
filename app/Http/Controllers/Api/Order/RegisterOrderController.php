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
        $request->validate(['client_secret' => [
            'required', 'string',
        ]]);


        try {
            $order = $repository->save($request->get('client_secret'));
            // todo: order_link

            return response()->json([
                'success' => true,
                'order_link' => url('/'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }
}
