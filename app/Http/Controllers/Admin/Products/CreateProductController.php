<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Category;
use App\Repositories\Product\CreateProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateProductController extends Controller
{
    /**
     * @return View|RedirectResponse
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.create')->with([
                'type' => 'Attention',
                'message' => 'Vous devez avoir au moins une catégorie avant de créer un produit.',
            ]);
        }

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreProductRequest $request, CreateProductRepository $repository): RedirectResponse
    {
        try {
            $repository->store($request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Le produit a bien été créé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
