<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\ViewModels\Products\EditProductView;
use Illuminate\Contracts\View\View;

class EditProductController extends Controller
{
    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => (new EditProductView($product->load(['categories'])))->get(),
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }
}
