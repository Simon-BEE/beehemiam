<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use App\Repositories\Product\CreateProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateProductController extends Controller
{
    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request, CreateProductRepository $repository): RedirectResponse
    {
        try {
            $repository->store($request->validated());

            return back()->with([
                'type' => 'success',
                'message' => 'Le produit a bien été créé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
