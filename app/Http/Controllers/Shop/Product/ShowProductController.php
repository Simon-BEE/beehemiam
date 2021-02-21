<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ShowProductController extends Controller
{
    public function __invoke(Category $category, Product $product)
    {
        $product->load(['productOptions.sizes.size', 'productOptions.images']);

        $productOption = $product->firstProductOption();

        return view('shop.products.show', [
            'category' => $category,
            'product' => $product,
            'productOptions' => $product->productOptions,
            'currentOption' => $productOption,
            'selectedSize' => $productOption->default_size,
        ]);
    }
}
