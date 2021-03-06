<?php

namespace App\Http\Controllers\Api\Products;

use App\Exceptions\Product\ProductAvailabilityException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductAvailabilityRequest;
use App\Models\ProductOption;
use App\Repositories\Product\ProductAvailabilityRepository;
use Illuminate\Http\JsonResponse;

class ProductAvailabilityController extends Controller
{
    public function __invoke(
        StoreProductAvailabilityRequest $request,
        ProductAvailabilityRepository $repository,
        ProductOption $productOption
    ): JsonResponse {
        try {
            $repository->save($productOption, $request->get('email'));

            return response()->json([
                'type' => 'Succès',
                'message' => 'Vous serez averti dès lors que le vêtement sera disponible !',
            ]);
        } catch (ProductAvailabilityException $e) {
            return response()->json([
                'type' => 'Erreur',
                'message' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }
}
