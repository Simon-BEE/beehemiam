<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\ImageOption;
use Exception;
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
