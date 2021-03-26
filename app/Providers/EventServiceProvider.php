<?php

namespace App\Providers;

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
            \App\Listeners\Contact\RegisterMessageInDatabase::class,
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
        \App\Events\Order\OrderPartialRefundEvent::class => [
            \App\Listeners\Order\RefundPartialOrderAmount::class,
            \App\Listeners\Order\NotifyAdministratorsOrderRefund::class,
        ],
        \App\Events\Order\OrderHasStatusUpdated::class => [
            \App\Listeners\Order\NotifyUserOrderUpdated::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        \App\Listeners\Products\UpdateProductStatus::class,
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
        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\ProductOption::observe(\App\Observers\ProductOptionObserver::class);
        \App\Models\ImageOption::observe(\App\Observers\ImageOptionObserver::class);
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Address::observe(\App\Observers\AddressObserver::class);
        \App\Models\PreOrderProductOptionQuantity::observe(\App\Observers\PreOrderProductOptionQuantityObserver::class);
        \App\Models\ProductOptionSize::observe(\App\Observers\ProductOptionSizeObserver::class);
        \App\Models\Refund::observe(\App\Observers\RefundObserver::class);
    }
}
