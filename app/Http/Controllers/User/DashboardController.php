<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('user.dashboard', [
            'user' => $user,
            'lastOrder' => $user->orders()->with('status')->latest()->first(),
        ]);
    }
}
