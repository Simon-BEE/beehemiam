<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\ProductOptionSize;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateCartController extends Controller
{
    public function __invoke(
        Request $request,
        CartRepository $repository,
        ProductOptionSize $productOptionSize
    ): JsonResponse {
        $request->validate([
            'quantity' => [
                'required', 'numeric', 'between:1,10',
            ]
        ]);

        try {
            $repository->update($productOptionSize, $request->get('quantity'));

            return response()->json([
                'message' => 'Quantité mise à jour',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
