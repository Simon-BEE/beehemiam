<?php

namespace App\Repositories\Product;

use App\Models\PreOrderProductOptionQuantity;
use App\Models\ProductOption;
use App\Models\ProductOptionSize;
use App\Traits\Files\ImageUploaderTrait;
use Illuminate\Http\UploadedFile;

class ProductAndOptionRepository
{
    use ImageUploaderTrait;

    /**
     * Loop and call product option image storage method
     *
     * @param ProductOption $productOption
     * @param array $images
     * @return void
     */
    protected function storeProductOptionImages(ProductOption $productOption, array $images): void
    {
        foreach ($images as $newImage) {
            $this->storeProductOptionImage($productOption, $newImage);
        }
    }

    /**
     * Store in PreOrderProductOptionQuantities table a pre-order quantity
     *
     * @param ProductOption $productOption
     * @param integer $quantity
     * @return void
     */
    protected function storePreOrderQuantity(ProductOption $productOption, int $quantity): void
    {
        PreOrderProductOptionQuantity::updateOrCreate(
            ['product_option_id' => $productOption->id],
            ['quantity' => $quantity],
        );
    }

    /**
     * Store for each options a size and its quantity
     *
     * @param ProductOption $productOption
     * @param array $sizesWithQuantityData
     * @return void
     */
    protected function storeOptionsSizes(ProductOption $productOption, array $sizesWithQuantityData): void
    {
        foreach ($sizesWithQuantityData as $sizeWithQuantity) {
            ProductOptionSize::updateOrCreate(
                ['product_option_id' => $productOption->id, 'size_id' => $sizeWithQuantity['id']],
                ['quantity' => $sizeWithQuantity['quantity']],
            );
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
            'full_path' => $thumbnail,
            'is_thumb' => true,
        ]);
    }
}
