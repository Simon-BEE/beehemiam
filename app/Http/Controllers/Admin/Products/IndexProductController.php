<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IndexProductController extends Controller
{
    public function __invoke(): View
    {
        $products = Product::with(['productOptions.sizes', 'productOptions.preOrderStock']);

        if (request()->get('name') || request()->get('status')) {
            $products = $this->filterProducts($products);
        }

        return view('admin.products.index', [
            'products' => $products->orderBy('id', 'desc')
                ->paginate(10),
        ]);
    }

    private function filterProducts(Builder|Model $products): Builder|Model
    {
        $products
            ->when(request()->get('name'), function ($query) {
                $searchTerm = request()->get('name');

                return $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('productOptions', function ($query) use ($searchTerm) {
                        return $query->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            })
            ->when(request()->get('status'), function ($query) {
                $searchTerm = request()->get('status');

                return $query
                    ->when($searchTerm === 'preorder', function ($query) {
                        return $query->where('is_preorder', true);
                    })
                    ->when($searchTerm === 'order', function ($query) {
                        return $query->where('is_preorder', false);
                    });
            });

        return $products;
    }
}
