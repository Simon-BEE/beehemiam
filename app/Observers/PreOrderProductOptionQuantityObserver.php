<?php

namespace App\Observers;

use App\Events\Product\ProductOptionUpdatedEvent;
use App\Models\PreOrderProductOptionQuantity;
use App\Models\User;
use App\Notifications\Product\ProductOutOfStockNotification;
use Illuminate\Support\Facades\Notification;

class PreOrderProductOptionQuantityObserver
{
    public function saving(PreOrderProductOptionQuantity $preOrderProductOptionQuantity): void
    {
        if ($preOrderProductOptionQuantity->quantity > 0
            && $preOrderProductOptionQuantity->productOption->availabilityNotifications->isNotEmpty()) {
            event(new ProductOptionUpdatedEvent($preOrderProductOptionQuantity->productOption));
        }
    }

    public function updated(PreOrderProductOptionQuantity $preOrderProductOptionQuantity)
    {
        if ($preOrderProductOptionQuantity->quantity < 1) {
            Notification::send(
                User::administrators(),
                new ProductOutOfStockNotification($preOrderProductOptionQuantity)
            );
        }
    }
}
