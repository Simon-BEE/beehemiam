<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class IndexProductController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.products.index', [
            'products' => Product::with(['productOptions.sizes', 'productOptions.preOrderStock'])
                ->orderBy('id', 'desc')
                ->paginate(10),
        ]);
    }
}
