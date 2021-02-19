<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class IndexShopController extends Controller
{
    public function __invoke(): View
    {
        return view('shop.index', [
            'categories' => Category::active()->get(),
        ]);
    }
}
