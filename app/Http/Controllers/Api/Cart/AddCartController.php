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

class AddCartController extends Controller
{
    public function addOrder(OrderCartRepository $repository, ProductOptionSize $productOptionSize): JsonResponse
    {
        try {
            $repository->add($productOptionSize);

            return response()->json([
                'message' => 'Vêtement ajouté au panier',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }

    public function addPreOrder(PreOrderCartRepository $repository, Request $request): JsonResponse
    {
        /** @var ProductOption $productOption */
        $productOption = ProductOption::findOrFail($request->get('product_option_id'));
        /** @var Size $size */
        $size = Size::findOrFail($request->get('size_id'));

        try {
            $repository->add($productOption, $size);

            return response()->json([
                'message' => 'Précommande ajouté au panier',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }
}
