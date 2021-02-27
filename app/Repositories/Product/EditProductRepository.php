<?php

namespace App\Repositories\Product;

use App\Exceptions\Product\ProductActiveStatusException;;
use App\Models\Product;

class EditProductRepository extends ProductRepository
{
    public function update(Product $product, array $validatedData): Product
    {
        if (isset($validatedData['is_active']) && !$product->is_active && !$product->hasOptionsQuantities) {
            throw new ProductActiveStatusException(
                "Le produit ne peut pas être mis en ligne sans options avec tailles et quantités.",
                1
            );
        }

        // if not preorder and has options, sort and filter sizes options (remove null values)
        if (!isset($validatedData['is_preorder']) && isset($validatedData['options'])) {
            $validatedData = $this->checkAndReOrderSizeAndQuantity($validatedData);
        }

        // if is_preorder is not checked and product was is_preorder so unset is_preorder
        if ($product->is_preorder && !isset($validatedData['is_preorder'])) {
            $validatedData['is_preorder'] = false;
        }

        // if is_active is not checked and product was is_active so unset is_active
        if ($product->is_active && !isset($validatedData['is_active'])) {
            $validatedData['is_active'] = false;
        }

        if (isset($validatedData['options'])) {
            $this->saveProductOptions(
                $product,
                $validatedData['options'],
                isset($validatedData['is_preorder']) && $validatedData['is_preorder'] == 1,
            );
        }
        
        $product->update($validatedData);
        
        $product->categories()->sync($validatedData['categories']);

        return $product->fresh();
    }
}
