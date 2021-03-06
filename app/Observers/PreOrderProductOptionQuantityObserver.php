<?php

namespace App\Observers;

use App\Events\Product\ProductOptionUpdatedEvent;
use App\Models\PreOrderProductOptionQuantity;

class PreOrderProductOptionQuantityObserver
{
    public function saving(PreOrderProductOptionQuantity $preOrderProductOptionQuantity): void
    {
        if ($preOrderProductOptionQuantity->quantity > 0 
            && $preOrderProductOptionQuantity->productOption->availabilityNotifications->isNotEmpty()) {
            event(new ProductOptionUpdatedEvent($preOrderProductOptionQuantity->productOption));
        }
    }
}
