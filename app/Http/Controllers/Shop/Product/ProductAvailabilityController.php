<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreProductAvailabilityRequest;
use App\Models\ProductOption;
use App\Repositories\Product\ProductAvailabilityRepository;
use Illuminate\Http\RedirectResponse;

class ProductAvailabilityController extends Controller
{
    public function __invoke(StoreProductAvailabilityRequest $request, 
        ProductAvailabilityRepository $repository, 
        ProductOption $productOption
    ): RedirectResponse
    {
        try {
            $repository->save($productOption, $request->get('email'));

            return back()->with([
                'type' => 'Succès',
                'message' => 'Vous serez averti dès lors que le vêtement sera disponible !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
