<?php

namespace App\Repositories\Product;

use App\Models\Product;

class EditProductRepository extends ProductRepository
{
    public function update(Product $product, array $validatedData): Product
    {
        if (!isset($validatedData['is_preorder']) && isset($validatedData['options'])) {
            $validatedData = $this->checkAndReOrderSizeAndQuantity($validatedData);
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
