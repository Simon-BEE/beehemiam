<?php

namespace App\Providers;

use App\Services\CacheUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Address' => 'App\Policies\AddressPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('cache-user', function () {
            return resolve(CacheUserProvider::class);
        });

        $this->registerPolicies();
    }
}
