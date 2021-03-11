<?php

namespace App\Services;

use Stripe\PaymentIntent;
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
            ],
        ]);
    }

    public function getClientSecret(PaymentIntent $paymentIntent): ?string
    {
        return $paymentIntent->client_secret;
    }
}
