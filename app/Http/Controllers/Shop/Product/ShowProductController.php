<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ShowProductController extends Controller
{
    public function __invoke(Category $category, Product $product)
    {
        return view('shop.products.show', [
            'category' => $category,
            'product' => $product->load(['productOptions.images']),
        ]);
    }
}
