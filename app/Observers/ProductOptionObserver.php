<?php

namespace App\Observers;

use App\Models\ProductOption;

class ProductOptionObserver
{
    /**
     * Handle the ProductOption "saving" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function saving(ProductOption $productOption)
    {
        $productOption->price = $productOption->price * 100;
    }
}
