<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\ProductOptionSize;
use App\Repositories\Shop\Cart\CartRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class RemoveCartController extends Controller
{
    public function __invoke(CartRepository $repository, ProductOptionSize $productOptionSize): JsonResponse
    {
        try {
            $repository->remove($productOptionSize);

            return response()->json([
                'message' => 'Vêtement supprimé du panier',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
