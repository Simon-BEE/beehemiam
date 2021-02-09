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

        foreach ($validatedData['options'] as $newOption) {
            $productOption = $this->storeProductOption($product, $newOption);

            foreach ($newOption['images'] as $newImage) {
                $this->storeProductOptionImage($productOption, $newImage);
            }
        }

        return $product;
    }

    private function storeProductOption(Product $product, array $validatedData): ProductOption
    {
        return $product->productOptions()->create($validatedData);
    }

    private function storeProductOptionImage(ProductOption $productOption, UploadedFile $file): void
    {
        extract($this->saveProductOptionImage($productOption, $file));

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