<?php

namespace App\Repositories\Product;

use App\Exceptions\ProductActiveStatusException;
use App\Models\ProductOption;

class OptionRepository extends ProductAndOptionRepository
{
    public function update(ProductOption $productOption, array $validatedData): ProductOption
    {
        if (isset($validatedData['images'])) {
            $this->storeProductOptionImages($productOption, $validatedData['images']);
        }

        if (isset($validatedData['sizes'])) {
            $validatedData['sizes'] = $this->checkAndReOrderSizeAndQuantity($validatedData['sizes']);
            $this->storeOptionsSizes($productOption, $validatedData['sizes']);
        }

        if (isset($validatedData['quantity'])) {
            $this->storePreOrderQuantity($productOption, $validatedData['quantity']);
        }

        return tap($productOption)->update($validatedData);
    }

    public function delete(ProductOption $productOption): void
    {
        $productOption->delete();
    }

    /**
     * Check if size array has a size_id and a quantity
     *
     * @param array $sizes
     * @return array
     */
    private function checkAndReOrderSizeAndQuantity(array $sizes): array
    {
        $sizesOrdered = array_filter(
            $sizes,
            function ($array) {
                return count($array) > 1;
            }
        );

        if (empty($sizesOrdered)) {
            throw new ProductActiveStatusException(
                "Une option doit avoir au moins une taille sélectionnée avec une quantité.",
                1
            );
        }

        return $sizesOrdered;
    }
}
