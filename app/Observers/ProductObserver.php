<?php

namespace App\Observers;

use App\Models\Product;
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
