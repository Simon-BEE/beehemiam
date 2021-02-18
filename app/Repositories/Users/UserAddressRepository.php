<?php

namespace App\Repositories\Users;

use App\Models\Address;
use App\Models\User;

class UserAddressRepository
{
    public function save(User $user, array $validatedData): Address
    {
        if (!isset($validatedData['is_main'])) {
            $validatedData['is_main'] = false;
        }

        if (!isset($validatedData['is_billing'])) {
            $validatedData['is_billing'] = false;
        }

        $address = $user->addresses()->create($validatedData);

        return $address;
    }
}
