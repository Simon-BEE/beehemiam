<?php

namespace App\Repositories\Shop\Cart;

use App\Models\Address;
use Illuminate\Support\Facades\Session;

class AddressCartRepository
{
    public function prepare(array $validatedData): void
    {
        $address = new Address(array_merge($validatedData, [
            'is_main' => true,
            'is_billing' => true,
        ]));

        $this->saveAddressInSession($address, true);
    }

    private function saveAddressInSession(Address $address, bool $isBilling = false): void
    {
        $addressType = $isBilling ? 'billing_address' : 'shipping_address';

        Session::put($addressType, $address);
    }
}
