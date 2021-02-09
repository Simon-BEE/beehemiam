<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ImageOption;
use App\Models\Product;
use App\Models\ProductOption;
use App\Observers\CategoryObserver;
use App\Observers\ImageOptionObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductOptionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerObservers();
    }

    private function registerObservers(): void
    {
        Product::observe(ProductObserver::class);
        ProductOption::observe(ProductOptionObserver::class);
        ImageOption::observe(ImageOptionObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
