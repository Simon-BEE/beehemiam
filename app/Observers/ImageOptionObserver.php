<?php

namespace App\Observers;

use App\Models\ImageOption;
use App\Traits\Files\ImageUploaderTrait;

class ImageOptionObserver
{
    use ImageUploaderTrait;

    /**
     * Handle the ImageOption "creating" event.
     *
     * @param  \App\Models\ImageOption  $imageOption
     * @return void
     */
    public function creating(ImageOption $imageOption): void
    {
        if (is_null($imageOption->productOption->main_image)) {
            $imageOption->is_main = true;
        }
    }

    /**
     * Handle the ImageOption "deleting" event.
     *
     * @param  \App\Models\ImageOption  $imageOption
     * @return void
     */
    public function deleting(ImageOption $imageOption): void
    {
        if ($imageOption->is_thumb) {
            return;
        }

        if (!$imageOption->is_thumb) {
            $this->removeThumbImage($imageOption->filename);
        }

        $this->removeProductImage($imageOption->full_path);
    }

    private function removeThumbImage(string $filename): void
    {
        $thumbImage = ImageOption::where('filename', $filename)->where('is_thumb', true)->first();
        $this->removeProductImage($thumbImage->full_path);
        $thumbImage->delete();
        if (config('app.env') !== 'testing') {
        }
    }
}
