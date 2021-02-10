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
        $product = Product::create([
            'name' => $validatedData['name'],
            'is_preorder' => isset($validatedData['is_preorder']),
            'is_active' => isset($validatedData['is_active']),
        ]);

        $product->categories()->sync($validatedData['categories']);

        $this->saveProductOptions(
            $product,
            $validatedData['options'],
            isset($validatedData['is_preorder']) && $validatedData['is_preorder'] === 1
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
}
