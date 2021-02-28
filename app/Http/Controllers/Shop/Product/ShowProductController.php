<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Contracts\View\View;

class ShowProductController extends Controller
{
    public function __invoke(Category $category, Product $product): View
    {
        abort_unless($product->is_active, 404);

        if ($product->is_preorder) {
            $product->load(['productOptions.preOrderStock', 'productOptions.images']);

            $sizes = Size::orderBy('id')->get();
        } else {
            $product->load(['productOptions.sizes.size', 'productOptions.images']);
        }

        $productOption = $product->firstProductOption();

        return view('shop.products.show', [
            'category' => $category,
            'product' => $product,
            'currentOption' => $productOption,
            'productOptions' => $product->productOptions,
            'selectedSize' => $product->is_preorder 
                ? $sizes->first()
                : $productOption->default_size,
            'sizes' => $sizes ?? null,
        ]);
    }
}
