<?php

namespace App\Observers;

use App\Models\ImageOption;

class ImageOptionObserver
{
    /**
     * Handle the ImageOption "creating" event.
     *
     * @param  \App\Models\ImageOption  $imageOption
     * @return void
     */
    public function creating(ImageOption $imageOption)
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
    public function deleting(ImageOption $imageOption)
    {
        if (!$imageOption->is_thumb) {
            ImageOption::where('filename', $imageOption->filename)->where('is_thumb', true)->delete();
        }
    }
}
