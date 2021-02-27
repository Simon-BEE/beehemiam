<?php

namespace App\Http\Controllers\Api\Cart;

use App\Exceptions\Coupon\CouponDoesNotExistException;
use App\Exceptions\Coupon\CouponIsNotEligibleException;
use App\Http\Controllers\Controller;
use App\Repositories\Coupon\CartCouponRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiCouponController extends Controller
{
    public function __invoke(Request $request, CartCouponRepository $repository): JsonResponse
    {
        try {
            $couponAmount = $repository->userAddCoupon($request->get('coupon'));

            return response()->json([
                'message' => 'Le code promo a bien été pris en compte',
                'amount' => $couponAmount,
            ]);
        } catch (CouponIsNotEligibleException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 419);
        } catch (CouponDoesNotExistException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 419);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
