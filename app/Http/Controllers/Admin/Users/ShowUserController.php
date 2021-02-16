<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class ShowUserController extends Controller
{
    public function show(User $user): View
    {
        return view('admin.users.show', [
            'user' => $user->load(['addresses']),
        ]);
    }

    public function orders(User $user): View
    {
        return view('admin.users.orders', [
            'user' => $user,
            'orders' => $user->orders()->paginate(),
        ]);
    }
}
