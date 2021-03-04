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

class RemoveCartController extends Controller
{
    public function deleteOrder(OrderCartRepository $repository, ProductOptionSize $productOptionSize): JsonResponse
    {
        try {
            $repository->remove($productOptionSize);

            return response()->json([
                'message' => 'Vêtement supprimé du panier',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }

    public function deletePreOrder(PreOrderCartRepository $repository, Request $request): JsonResponse
    {
        /** @var ProductOption $productOption */
        $productOption = ProductOption::findOrFail($request->get('product_option_id'));
        /** @var Size $size */
        $size = Size::findOrFail($request->get('size_id'));

        try {
            $repository->remove($productOption, $size);

            return response()->json([
                'message' => 'Vêtement supprimé du panier',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
