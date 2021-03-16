<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;

class StripeInteractorService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
    }

    public function createPaymentIntent(int $amountInCents): PaymentIntent
    {
        return PaymentIntent::create([
            'amount' => $amountInCents,
            'currency' => 'eur',
            'metadata' => [
                'email_address' => get_client_email(),
                'user_id' => auth()->id(),
            ],
        ]);
    }

    public function getClientSecret(PaymentIntent $paymentIntent): ?string
    {
        return $paymentIntent->client_secret;
    }

    public function getPaymentIntentId(PaymentIntent $paymentIntent): ?string
    {
        return $paymentIntent->id;
    }

    public function refund(Order $order, ?int $amount = null): Refund
    {
        if (is_null($amount)) {
            $payment = Payment::firstWhere('reference', $order->payment->reference);

            if (is_null($payment)) {
                throw new \Exception("Paiement introuvable", 1);
            }

            $amount = $payment->amount;
        }

        try {
            $refund = Refund::create([
                'payment_intent' => $order->payment->reference,
                'amount' => $amount,
            ]);

            return $refund;
        } catch (\Exception $e) {
            throw new \Exception("Impossible de procéder au remboursement. " . $e->getMessage(), 1);
        }
    }
}
