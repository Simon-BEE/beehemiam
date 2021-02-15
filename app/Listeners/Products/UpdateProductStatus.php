<?php

namespace App\Listeners\Products;

use App\Events\CategoryIsRemoved;
use App\Events\ProductOptionRemoved;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;

class UpdateProductStatus implements ShouldQueue
{
    public function onCategoryDeleted(): void
    {
        // Set products states to false if they dot not have categories
        Product::whereDoesntHave('categories')->update([
            'is_active' => false,
        ]);
    }

    public function onOptionDeleted(): void
    {
        // Set products states to false if they dot not have productOptions
        Product::whereDoesntHave('productOptions')->update([
            'is_active' => false,
        ]);
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            CategoryIsRemoved::class,
            'App\Listeners\Products\UpdateProductStatus@onCategoryDeleted',
        );

        $events->listen(
            ProductOptionRemoved::class,
            'App\Listeners\Products\UpdateProductStatus@onOptionDeleted',
        );
    }
}
