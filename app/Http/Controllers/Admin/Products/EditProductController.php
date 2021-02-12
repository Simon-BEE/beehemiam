<?php

namespace App\Http\Controllers\Admin\Products;

use App\Exceptions\ProductActiveStatusException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Repositories\Product\EditProductRepository;
use App\ViewModels\Products\EditProductView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditProductController extends Controller
{
    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => (new EditProductView($product->load(['categories', 'productOptions.images'])))->get(),
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
            'sizes' => Size::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function update(
        EditProductRepository $repository,
        UpdateProductRequest $request,
        Product $product
    ): RedirectResponse {
        try {
            $repository->update($product, $request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Le produit a bien été modifié !',
            ]);
        } catch (ProductActiveStatusException $e) {
            return back()->with([
                'type' => 'Erreur',
                'message' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
