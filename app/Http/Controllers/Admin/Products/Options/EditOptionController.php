<?php

namespace App\Http\Controllers\Admin\Products\Options;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateOptionRequest;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Size;
use App\Repositories\Product\OptionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditOptionController extends Controller
{
    public function edit(Product $product, ProductOption $productOption): View
    {
        return view('admin.products.options.edit', [
            'product' => $product,
            'productOption' => $productOption->load(['sizes', 'preOrderStock', 'imagesWithoutThumb']),
            'sizes' => Size::orderBy('id')->get(),
        ]);
    }

    public function update(
        OptionRepository $repository,
        UpdateOptionRequest $request,
        Product $product,
        ProductOption $productOption
    ): RedirectResponse {
        try {
            $repository->update($productOption, $request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'La variante du vêtement a bien été modifiée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
