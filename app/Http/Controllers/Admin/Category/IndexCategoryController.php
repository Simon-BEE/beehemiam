<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class IndexCategoryController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('products')->simplePaginate(10),
        ]);
    }
}
