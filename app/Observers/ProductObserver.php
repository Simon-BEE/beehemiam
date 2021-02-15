<?php

namespace App\Observers;

use App\Models\ImageOption;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = $this->generateSlug($product);
    }

    /**
     * Handle the Product "deleting" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleting(Product $product)
    {
        $product->productOptions->each(function (ProductOption $productOption) {
            $productOption->images->each(function (ImageOption $image) {
                $image->delete();
            });

            $productOption->delete();
        });
    }

    /**
     * Generate an unique slug
     *
     * @param Product $product
     * @return string
     */
    private function generateSlug(Product $product): string
    {
        $count = 0;
        $slug = Str::slug($product->name);

        while (DB::table('products')->where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $count++;
        }

        return $slug;
    }
}
