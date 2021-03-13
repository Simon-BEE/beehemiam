<?php

namespace App\Http\Controllers\Api\Payments;

use App\Http\Controllers\Controller;
use App\Services\CartAmountService;
use App\Services\StripeInteractorService;
use Illuminate\Http\JsonResponse;

class PaymentIntentController extends Controller
{
    public function __invoke(
        StripeInteractorService $stripeInteractorService,
        CartAmountService $cartAmountService
    ): JsonResponse {
        try {
            /** @var int $totalAmount */
            $totalAmount = $cartAmountService->getTotalAmount();
            $paymentIntent = $stripeInteractorService->createPaymentIntent($totalAmount);

            return response()->json([
                'client_secret' => $stripeInteractorService->getClientSecret($paymentIntent),
                'total_amount' => $totalAmount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur du serveur',
            ]);
        }
    }
}
