<?php

namespace App\Repositories\Product;

use App\Models\Product;

class CreateProductRepository extends ProductRepository
{
    public function store(array $validatedData): Product
    {
        if (!isset($validatedData['is_preorder'])) {
            $validatedData = $this->checkAndReOrderSizeAndQuantity($validatedData);
        }

        $product = Product::create([
            'name' => $validatedData['name'],
            'is_preorder' => isset($validatedData['is_preorder']),
            'is_active' => isset($validatedData['is_active']),
        ]);

        $product->categories()->sync($validatedData['categories']);

        $this->saveProductOptions(
            $product,
            $validatedData['options'],
            isset($validatedData['is_preorder']) && $validatedData['is_preorder'] == 1
        );

        return $product;
    }
}
