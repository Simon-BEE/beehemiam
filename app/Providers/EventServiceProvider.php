<?php

namespace App\Providers;

use App\Listeners\Products\UpdateProductStatus;
use App\Models\Address;
use App\Models\Category;
use App\Models\ImageOption;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Models\User;
use App\Observers\AddressObserver;
use App\Observers\CategoryObserver;
use App\Observers\ImageOptionObserver;
use App\Observers\PreOrderProductOptionQuantityObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductOptionObserver;
use App\Observers\ProductOptionSizeObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        \App\Events\FormContactMessageSend::class => [
            \App\Listeners\Contact\SendMessageToAdministrators::class,
            \App\Listeners\Contact\SendMessageCopyToAuthor::class,
        ],
        \App\Events\PasswordEdited::class => [
            \App\Listeners\Users\PasswordHasChanged::class,
        ],
        \App\Events\Product\ProductOptionUpdatedEvent::class => [
            \App\Listeners\Products\ProductOptionAvalaibilityListener::class,
        ],
        \App\Events\Order\NewOrderReceivedEvent::class => [
            \App\Listeners\Order\CreateOrderItems::class,
            \App\Listeners\Order\CreateCouponOrder::class,
            \App\Listeners\Order\AdjustStockQuantities::class,
            \App\Listeners\Order\GenerateOrderInvoice::class,
            \App\Listeners\Order\SavePaymentOrder::class,
            \App\Listeners\Order\SendOrderSummaryEmail::class,
            \App\Listeners\Order\NotifyAdministratorsNewOrder::class,
        ],
        \App\Events\Order\NewOrderCancelledEvent::class => [
            \App\Listeners\Order\RefundTotalOrderAmount::class,
            \App\Listeners\Order\RestoreProductsQuantities::class,
            \App\Listeners\Order\RemoveCouponOrder::class,
            \App\Listeners\Order\NotifyUserOrderIsCancelled::class,
            \App\Listeners\Order\NotifyAdministratorsOrderIsCancelled::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UpdateProductStatus::class,
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
        User::observe(UserObserver::class);
        Address::observe(AddressObserver::class);
        PreOrderProductOptionQuantity::observe(PreOrderProductOptionQuantityObserver::class);
        ProductOptionSize::observe(ProductOptionSizeObserver::class);
    }
}
