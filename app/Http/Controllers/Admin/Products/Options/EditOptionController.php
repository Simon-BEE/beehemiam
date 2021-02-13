<?php

namespace App\Http\Controllers\Admin\Products\Options;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Size;
use Illuminate\Contracts\View\View;

class EditOptionController extends Controller
{
    public function edit(Product $product, ProductOption $productOption): View
    {
        // dd($product, $productOption->sizes);

        return view('admin.products.options.edit', [
            'product' => $product,
            'productOption' => $productOption->load(['sizes', 'preOrderStock']),
            'sizes' => Size::orderBy('id')->get(),
        ]);
    }
}
