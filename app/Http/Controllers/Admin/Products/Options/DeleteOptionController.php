<?php

namespace App\Http\Controllers\Admin\Products\Options;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Repositories\Product\OptionRepository;
use Illuminate\Http\RedirectResponse;

class DeleteOptionController extends Controller
{
    public function __invoke(
        OptionRepository $repository,
        Product $product,
        ProductOption $productOption
    ): RedirectResponse {
        try {
            $repository->delete($productOption);

            return redirect()->route('admin.products.index')->with([
                'type' => 'Succès',
                'message' => 'La variante a bien été supprimée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
