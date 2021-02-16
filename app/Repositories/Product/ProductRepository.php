<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductOption;

class ProductRepository extends ProductAndOptionRepository
{
    /**
     * Dispatch product options storing
     *
     * @param Product $product
     * @param array $options
     * @param boolean $isPreOrder
     * @return void
     */
    public function saveProductOptions(Product $product, array $options, bool $isPreOrder): void
    {
        foreach ($options as $newOption) {
            $productOption = $this->storeProductOption($product, $newOption);
            
            if ($isPreOrder) {
                $this->storePreOrderQuantity($productOption, $newOption['quantity']);
            } else {
                $this->storeOptionsSizes($productOption, $newOption['sizes']);
            }

            $this->storeProductOptionImages($productOption, $newOption['images']);
        }
    }

    /**
     * Check if each sizes field has a size_id and a quantity
     *
     * @param array $validatedData
     * @return array
     */
    protected function checkAndReOrderSizeAndQuantity(array $validatedData): array
    {
        foreach ($validatedData['options'] as $key => $option) {
            $validatedData['options'][$key]['sizes'] = array_filter(
                $option['sizes'],
                function ($array) {
                    return count($array) > 1;
                }
            );

            if (empty($validatedData['options'][$key]['sizes'])) {
                throw new \Exception("Chaque option doit avoir au moins une taille sélectionnée avec une quantité.", 1);
            }
        }

        return $validatedData;
    }

    /**
     * Store one product option
     *
     * @param Product $product
     * @param array $validatedData
     * @return ProductOption
     */
    private function storeProductOption(Product $product, array $validatedData): ProductOption
    {
        return $product->productOptions()->create($validatedData);
    }
}
