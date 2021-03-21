<?php

namespace App\View\Composers;

use App\Models\Country;
use App\Models\User;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;

class AdminViewComposer
{
    public function __construct(private CartRepository $cartRepository)
    {
        //
    }

    public function compose(View $view): void
    {
        /** @var User $admin */
        $admin = auth()->user();

        $view->with([
            'notifications' => $admin->adminNotifications()->get(),
        ]);
    }
}
