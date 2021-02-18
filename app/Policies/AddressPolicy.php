<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AddressPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Address $address): Response
    {
        if ($user->id !== $address->user->id) {
            abort(404);
        }

        return Response::allow();
    }

    public function delete(User $user, Address $address): Response
    {
        if ($user->id !== $address->user->id) {
            abort(403);
        }

        return Response::allow();
    }
}
