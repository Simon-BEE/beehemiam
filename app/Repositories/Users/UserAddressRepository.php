<?php

namespace App\Repositories\Users;

use App\Models\Address;
use App\Models\User;

class UserAddressRepository
{
    public function save(User $user, array $validatedData): Address
    {
        return $user->addresses()->create(array_merge($validatedData, [
            'is_main' => isset($validatedData['is_main']),
            'is_billing' => isset($validatedData['is_billing']),
        ]));
    }

    public function update(Address $address, array $validatedData): Address
    {
        $validatedData['is_main'] = $validatedData['is_main']
            ?? ($address->user->address->is($address) ?? false);

        $validatedData['is_billing'] = $validatedData['is_billing']
            ?? ($address->user->address->is($address) ?? false);

        return tap($address)->update(array_merge($validatedData, [
            'is_main' => $validatedData['is_main'],
            'is_billing' => $validatedData['is_billing'],
        ]));
    }

    public function setAsMain(Address $address): void
    {
        $address->update([
            'is_main' => true,
        ]);
    }

    public function delete(Address $address): void
    {
        $address->delete();
    }
}
