<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Product\DeleteProductRepository;
use Exception;
use Illuminate\Http\RedirectResponse;

class DeleteProductController extends Controller
{
    public function __invoke(DeleteProductRepository $repository, Product $product): RedirectResponse
    {
        try {
            $repository->delete($product);

            return redirect()->route('admin.products.index')->with([
                'type' => 'Succès',
                'message' => 'Le produit a bien été supprimé !',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
