<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Category;
use App\Models\Size;
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
        $categories = Category::select('id', 'name')->orderBy('name')->get();

        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.create')->with([
                'type' => 'Attention',
                'message' => 'Vous devez avoir au moins une catégorie avant de continuer.',
            ]);
        }

        return view('admin.products.create', [
            'categories' => $categories,
            'sizes' => Size::orderBy('id')->get(),
        ]);
    }

    public function store(StoreProductRequest $request, CreateProductRepository $repository): RedirectResponse
    {
        try {
            $product = $repository->save($request->validated());

            return redirect()->route('admin.products.edit', $product)->with([
                'type' => 'Succès',
                'message' => 'Le produit a bien été créé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
