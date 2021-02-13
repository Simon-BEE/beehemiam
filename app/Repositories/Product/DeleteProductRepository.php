<?php

namespace App\Repositories\Product;

use App\Models\Product;

class DeleteProductRepository
{
    public function delete(Product $product): void
    {
        $product->delete();
    }
}
