<?php

namespace App\Observers;

use App\Models\ProductOption;

class ProductOptionObserver
{
    /**
     * Handle the ProductOption "creating" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function creating(ProductOption $productOption)
    {
        $productOption->price = $productOption->price * 100;
    }
}
