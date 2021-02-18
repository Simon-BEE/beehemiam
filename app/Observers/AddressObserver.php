<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the Address "creating" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function creating(Address $address)
    {
        if ($address->user->addresses()->count() < 1) {
            $address->is_main = true;
            $address->is_billing = true;
        }
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function deleted(Address $address)
    {
        if (!$address->is_main && !$address->is_billing) {
            return;
        }

        if ($address->user->addresses()->count() < 1) {
            return;
        }

        $address->user->addresses()->first()->update([
            'is_main' => $address->is_main,
            'is_billing' => $address->is_billing,
        ]);
    }

    /**
     * Handle the Address "saving" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function saving(Address $address)
    {
        $this->checkAddressDefault($address, 'is_main');
        $this->checkAddressDefault($address, 'is_billing');
    }

    private function checkAddressDefault(Address $address, string $property)
    {
        if ($property !== 'is_billing' && $property !== 'is_main') {
            throw new \Exception("Property '$property' is not defined in Address Model", 1);
        }

        if (is_null($address->user->address) || !$address->$property) {
            return;
        }

        if ($address->getOriginal() && $address->getOriginal($property) === true) {
            return;
        }

        $address->user->addresses()->update([$property => false]);
    }
}
