<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class IndexPreOrderController extends Controller
{
    public function __invoke(): View
    {
        return view('shop.preorders.index', [
            'products' => Product::active()->where('is_preorder', true)->get(),
        ]);
    }
}
