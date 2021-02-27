<?php

namespace App\Http\Controllers\Admin\Products;

use App\Exceptions\Product\ProductActiveStatusException;;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Repositories\Product\EditProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditProductController extends Controller
{
    /**
     * @return View|RedirectResponse
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();

        if ($categories->isEmpty()) {
            return redirect()->route('admin.categories.create')->with([
                'type' => 'Attention',
                'message' => 'Vous devez avoir au moins une catégorie avant de continuer.',
            ]);
        }

        return view('admin.products.edit', [
            'product' => $product->load(['categories', 'productOptions.images']),
            'categories' => $categories,
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
