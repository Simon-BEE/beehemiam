<?php

namespace App\Listeners\Products;

use App\Events\Product\ProductOptionUpdatedEvent;
use App\Mail\Products\ProductAvailableMail;
use App\Models\ProductNotification;
use Illuminate\Support\Facades\Mail;

class ProductOptionAvalaibilityListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductOptionUpdatedEvent  $event
     * @return void
     */
    public function handle(ProductOptionUpdatedEvent $event)
    {
        $event->productOption->availabilityNotifications->each(
            function (ProductNotification $productNotification) use ($event) {
                Mail::to($productNotification->email ?? $productNotification->user->email)
                    ->send(new ProductAvailableMail($event->productOption, $productNotification->user));
            }
        );

        $event->productOption->availabilityNotifications()->delete();
    }
}
