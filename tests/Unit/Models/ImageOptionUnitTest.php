<?php

namespace Tests\Unit\Models;

use App\Models\ImageOption;
use App\Models\ProductOption;
use Tests\TestCase;

class ImageOptionUnitTest extends TestCase
{
    /** @test */
    public function an_image_has_a_property_to_get_image_public_path()
    {
        $productOption = ProductOption::factory()->create();
        $img = ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);

        $this->assertNotNull($img->path);
    }
    
}
