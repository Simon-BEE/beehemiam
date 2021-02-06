<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class CreateProductController extends Controller
{
    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            return $product;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
