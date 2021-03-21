<?php

namespace App\Providers;

use App\View\Composers\AdminViewComposer;
use App\View\Composers\CartViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['shop.cart.index', 'shop.cart.shipping', 'shop.cart.orders.index'],
            CartViewComposer::class
        );

        View::composer(['admin.*'], AdminViewComposer::class);
    }
}
