<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Models\ProductOptionSize;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Http\JsonResponse;

class AddCartController extends Controller
{
    public function __invoke(CartRepository $repository, ProductOptionSize $productOptionSize): JsonResponse
    {
        try {
            $repository->add($productOptionSize);

            return response()->json([
                'message' => 'Vêtement ajouté au panier',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
