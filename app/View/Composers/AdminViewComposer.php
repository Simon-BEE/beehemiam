<?php

namespace App\View\Composers;

use App\Models\Country;
use App\Models\User;
use App\Repositories\Shop\Cart\CartRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

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
            'notifications' => Cache::remember('adminNotifications', now()->addMinutes(10), function () use ($admin) {
                return $admin->adminNotifications()->get();
            }),
        ]);
    }
}
