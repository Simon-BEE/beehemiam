<?php

namespace App\Observers;

use App\Events\ProductOptionRemoved;
use App\Models\ImageOption;
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

    /**
     * Handle the ProductOption "deleting" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function deleting(ProductOption $productOption)
    {
        $productOption->images->each(function (ImageOption $image) {
            $image->delete();
        });
    }

    /**
     * Handle the ProductOption "deleted" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function deleted(ProductOption $productOption)
    {
        ProductOptionRemoved::dispatch();
    }
}
