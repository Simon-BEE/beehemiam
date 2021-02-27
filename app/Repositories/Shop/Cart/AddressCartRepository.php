<?php

namespace App\Repositories\Shop\Cart;

use App\Models\Address;
use Illuminate\Support\Facades\Session;

class AddressCartRepository
{
    public function prepare(array $validatedData): void
    {
        if (isset($validatedData['billing']) && !empty($validatedData['billing'])) {
            $billingAddress = new Address(array_merge($validatedData['billing'], [
                'is_main' => false,
                'is_billing' => true,
            ]));

            $this->saveAddressInSession($billingAddress, $billingAddress->is_billing);
        }

        $shippingAddress = new Address(array_merge($validatedData, [
            'is_main' => true,
            'is_billing' => isset($validatedData['billing']) ? false : true,
        ]));

        $this->saveAddressInSession($shippingAddress, $shippingAddress->is_billing);
    }

    private function saveAddressInSession(Address $address, bool $isBilling = false): void
    {
        $addressType = $isBilling ? 'billing_address' : 'shipping_address';

        Session::put($addressType, $address);
    }
}
