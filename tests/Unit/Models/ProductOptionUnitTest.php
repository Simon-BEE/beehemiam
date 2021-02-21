<?php

namespace Tests\Unit\Models;

use App\Models\ImageOption;
use App\Models\ProductOption;
use Tests\TestCase;

class ProductOptionUnitTest extends TestCase
{
    /** @test */
    public function an_option_has_access_to_its_images_without_thumb()
    {
        $productOption = ProductOption::factory()->create();
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image_thumb.jpg',
            'full_path' => 'path/image_thumb.jpg',
            'is_thumb' => true,
        ]);

        $this->assertCount(2, $productOption->images);
        $this->assertCount(1, $productOption->imagesWithoutThumb);
    }
    
    /** @test */
    public function an_option_has_a_default_size()
    {
        $productOption = ProductOption::factory()->create();
        $productOption->sizes()->create([
            'size_id' => 1, 'quantity' => 10,
        ]);
        $productOption->sizes()->create([
            'size_id' => 2, 'quantity' => 10,
        ]);
        $productOption->sizes()->create([
            'size_id' => 3, 'quantity' => 10,
        ]);

        $this->assertNotNull($productOption->defaultSize);
        $this->assertEquals('XS', $productOption->defaultSize->size->name);
    }

    /** @test */
    public function an_option_has_a_property_is_available()
    {
        $productOption = ProductOption::factory()->create();

        $this->assertNotNull($productOption->is_available);
        $this->assertFalse($productOption->is_available);
        
        $productOption->sizes()->create([
            'size_id' => 1, 'quantity' => 10,
        ]);

        $this->assertTrue($productOption->fresh()->is_available);
    }
    
    
}
