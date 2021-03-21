<?php

namespace App\Http\Controllers\Shop\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query();
        $searchTerm = $request->get('q');

        $products->when($searchTerm, function ($query) use ($searchTerm) {
            return $query->with(['productOptions.images', 'categories:id,slug'])
                ->where('name', 'LIKE', "%$searchTerm%")
                ->orWhereHas('productOptions', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%$searchTerm%")
                        ->select(['id', 'name', 'slug', 'description']);
                })
                ->select(['id', 'name', 'slug']);
        });

        return view('shop.search.index', [
            'products' => $products->get(),
        ]);
    }
}
