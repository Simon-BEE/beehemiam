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
     * Handle the Address "saving" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function saving(Address $address)
    {
        if ($address->is_main && !is_null($address->user->address)) {
            $address->user->addresses()->update(['is_main' => false]);
        }

        if ($address->is_billing && !is_null($address->user->address)) {
            $address->user->addresses()->update(['is_billing' => false]);
        }
    }
}
