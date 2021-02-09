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

        $path = Storage::disk('products')->putFileAs((string)$productOption->id, $file, $filename);

        if ($path === false) {
            throw new \Exception("Path is empty, file was not uploaded.", 1);
        }

        return [
            'fullPath' => storage_path('app/products') . '/' . $path,
            'fileName' => $filename,
            'thumbnail' => $this->makeThumbnail($file, $path),
        ];
    }

    public function makeThumbnail(UploadedFile $file, string $path): string
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
            . md5(uniqid(microtime()))
            . '.'
            . $imageExtension;
    }

    private function removeExtension(string $completeFileName): string
    {
        $dotPosition = (strrpos($completeFileName, "."));

        if ($dotPosition === false) {
            throw new \Exception("No dot found in filename.", 1);
        }

        return substr($completeFileName, 0, $dotPosition);
    }
}
