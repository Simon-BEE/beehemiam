<?php

namespace App\Traits\Files;

use App\Models\ProductOption;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait ImageUploaderTrait
{
    public function saveProductOptionImage(ProductOption $productOption, UploadedFile $file): array
    {
        $filename = $this->generateFileName(
            $this->removeExtension($file->getClientOriginalName()), 
            $file->getClientOriginalExtension()
        );

        $path = Storage::disk('products')->putFileAs($productOption->id, $file, $filename);

        return [
            'fullPath' => storage_path('app/products') . '/' . $path,
            'fileName' => $filename,
            'thumbnail' => $this->makeThumbnail($file, $path),
        ];
    }

    public function makeThumbnail(UploadedFile $file, string $path)
    {
        $img = Image::make($file)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('products')->put('/thumbs/' . $path, $img);

        return '/thumbs/' . $path;
    }

    private function generateFilename(string $originalFileName, string $imageExtension): string
    {
        return $originalFileName 
            . '-' 
            . md5(uniqid(microtime(true))) 
            . '.'
            . $imageExtension;
    }

    private function removeExtension(string $completeFileName): string
    {
        return substr($completeFileName, 0 , (strrpos($completeFileName, ".")));
    }
}
