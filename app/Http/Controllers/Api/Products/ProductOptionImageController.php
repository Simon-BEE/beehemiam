<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\ImageOption;
use Illuminate\Http\JsonResponse;

class ProductOptionImageController extends Controller
{
    public function destroy(ImageOption $image): JsonResponse
    {
        try {
            $image->delete();

            return response()->json([
                'message' => 'OK',
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());

            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }
}
