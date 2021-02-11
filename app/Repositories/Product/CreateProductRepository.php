<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductOption;
use App\Traits\Files\ImageUploaderTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateProductRepository
{
    use ImageUploaderTrait;

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

            foreach ($newOption['images'] as $newImage) {
                $this->storeProductOptionImage($productOption, $newImage);
            }
        }
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

    /**
     * Store in PreOrderProductOptionQuantities table a pre-order quantity
     *
     * @param ProductOption $productOption
     * @param integer $quantity
     * @return void
     */
    private function storePreOrderQuantity(ProductOption $productOption, int $quantity): void
    {
        $productOption->preOrderStock()->create([
            'quantity' => $quantity,
        ]);
    }

    /**
     * Store for each options a size and its quantity
     *
     * @param ProductOption $productOption
     * @param array $sizesWithQuantityData
     * @return void
     */
    public function storeOptionsSizes(ProductOption $productOption, array $sizesWithQuantityData): void
    {
        foreach ($sizesWithQuantityData as $sizeWithQuantity) {
            $productOption->sizes()->create([
                'size_id' => $sizeWithQuantity['id'],
                'quantity' => $sizeWithQuantity['quantity'],
            ]);
        }
    }

    /**
     * Store one image of a ProductOption
     *
     * @param ProductOption $productOption
     * @param UploadedFile $file
     * @return void
     */
    private function storeProductOptionImage(ProductOption $productOption, UploadedFile $file): void
    {
        // phpstan doesnt like extract :/
        $optionImage = $this->saveProductOptionImage($productOption, $file);
        $fileName = $optionImage['fileName'];
        $fullPath = $optionImage['fullPath'];
        $thumbnail = $optionImage['thumbnail'];

        $productOption->images()->create([
            'filename' => $fileName,
            'full_path' => $fullPath,
        ]);

        $productOption->images()->create([
            'filename' => $fileName,
            'full_path' => storage_path('app/products') . $thumbnail,
            'is_thumb' => true,
        ]);
    }

    /**
     * Check if each sizes field has a size_id and a quantity
     *
     * @param array $validatedData
     * @return array
     */
    private function checkAndReOrderSizeAndQuantity(array $validatedData): array
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
}
