<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\ImageOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductOptionImageController extends Controller
{
    public function destroy(Request $request, ImageOption $image): JsonResponse
    {
        try {
            $image->delete();

            return response()->json([
                'message' => 'OK',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
