<?php

namespace App\Observers;

use App\Events\Product\ProductOptionUpdatedEvent;
use App\Models\ProductOptionSize;

class ProductOptionSizeObserver
{
    public function saving(ProductOptionSize $productOptionSize): void
    {
        if ($productOptionSize->quantity > 0 
            && $productOptionSize->productOption->availabilityNotifications->isNotEmpty()) {
            event(new ProductOptionUpdatedEvent($productOptionSize->productOption));
        }
    }
}
