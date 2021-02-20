<?php

namespace App\Http\Controllers\Shop\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category): View
    {
        return view('shop.categories.show', [
            'category' => $category,
            'products' => $category->products()->with('productOptions')->get(),
        ]);
    }
}
