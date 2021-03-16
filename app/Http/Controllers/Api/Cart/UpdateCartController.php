<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Models\Size;
use App\Repositories\Shop\Cart\OrderCartRepository;
use App\Repositories\Shop\Cart\PreOrderCartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateCartController extends Controller
{
    public function updateOrder(
        Request $request,
        OrderCartRepository $repository,
        ProductOptionSize $productOptionSize
    ): JsonResponse {
        $this->validQuantityRequest();

        try {
            $repository->update($productOptionSize, $request->get('quantity'));

            return response()->json([
                'message' => 'Quantité mise à jour',
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());

            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }

    public function updatePreOrder(
        Request $request,
        PreOrderCartRepository $repository,
    ): JsonResponse {
        $this->validQuantityRequest();

        /** @var ProductOption $productOption */
        $productOption = ProductOption::findOrFail($request->get('product_option_id'));
        /** @var Size $size */
        $size = Size::findOrFail($request->get('size_id'));

        try {
            $repository->update($productOption, $size, $request->get('quantity'));

            return response()->json([
                'message' => 'Quantité mise à jour',
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }

    private function validQuantityRequest(): void
    {
        request()->validate([
            'quantity' => [
                'required', 'numeric', 'between:0,10',
            ]
        ]);
    }
}
