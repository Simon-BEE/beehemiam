<?php

namespace App\Services;

use App\Models\Shipping;

class CartAmountService
{
    /**
     * Return total amount (all products, shipping fees, taxes) in cents
     *
     * @return integer
     */
    public function getTotalAmount(): int
    {
        return get_cart_subtotal(false, 'order')
            + get_cart_subtotal(false, 'preorder')
            + $this->getShippingFeesAmount();
    }

    public function getShippingFeesAmount(): int
    {
        return $this->getShipping()->price;
    }

    public function getTaxesAmount(): int
    {
        return config('cart.tax');
    }

    public function getShipping(): Shipping
    {
        $address = get_client_shipping_address();

        if (is_null($address)) {
            throw new \Exception("Impossible d'obtenir l'adresse de livraison", 1);
        }

        return $address->country->shippings->first();
    }
}
