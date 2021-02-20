<?php

namespace App\Http\Controllers\Shop\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class IndexCategoryController extends Controller
{
    public function __invoke(): View
    {
        return view('shop.categories.index', [
            'categories' => Category::withCount('products')->active()->get(),
        ]);
    }
}
