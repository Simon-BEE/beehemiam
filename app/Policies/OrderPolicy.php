<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Order $order): Response
    {
        if (is_null($order->user) || $user->id !== $order->user->id) {
            abort(404);
        }

        return Response::allow();
    }
}
