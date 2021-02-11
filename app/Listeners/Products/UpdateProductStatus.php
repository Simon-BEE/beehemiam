<?php

namespace App\Listeners\Products;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProductStatus implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        // Set products states to false if they dot not have categories 
        Product::whereDoesntHave('categories')->update([
            'is_active' => false,
        ]);
    }
}
