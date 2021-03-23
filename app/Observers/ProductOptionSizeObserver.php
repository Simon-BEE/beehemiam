<?php

namespace App\Observers;

use App\Events\Product\ProductOptionUpdatedEvent;
use App\Models\ProductOptionSize;
use App\Models\User;
use App\Notifications\Product\ProductOutOfStockNotification;
use Illuminate\Support\Facades\Notification;

class ProductOptionSizeObserver
{
    public function saving(ProductOptionSize $productOptionSize): void
    {
        if ($productOptionSize->quantity > 0
            && $productOptionSize->productOption->availabilityNotifications->isNotEmpty()) {
            event(new ProductOptionUpdatedEvent($productOptionSize->productOption));
        }
    }

    public function updated(ProductOptionSize $productOptionSize): void
    {
        if ($productOptionSize->quantity < 1) {
            Notification::send(User::administrators()->get(), new ProductOutOfStockNotification($productOptionSize));
        }
    }
}
