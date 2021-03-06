<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\ImageOption;
use App\Models\Product;
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
    public function an_option_has_a_property_is_available_for_normal_order()
    {
        $productOption = ProductOption::factory()->create();

        $this->assertNotNull($productOption->is_available);
        $this->assertFalse($productOption->is_available);
        
        $productOption->sizes()->create([
            'size_id' => 1, 'quantity' => 10,
        ]);

        $this->assertTrue($productOption->fresh()->is_available);
    }

    /** @test */
    public function an_option_has_a_property_is_available_for_preorder()
    {
        $product = Product::factory()->preorder()->active()->create();
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertNotNull($productOption->is_available);
        $this->assertFalse($productOption->is_available);
        
        $productOption->preOrderStock()->create([
            'quantity' => 10,
        ]);

        $this->assertTrue($productOption->fresh()->is_available);
    }

    /** @test */
    public function a_preorder_option_has_a_property_release_date()
    {
        $product = Product::factory()->preorder()->active()->create();
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertNull($productOption->release_at);
        
        $productOption->preOrderStock()->create([
            'quantity' => 10,
        ]);

        $this->assertEquals(
            now()->addWeeks(config('beehemiam.preorder.release_date_weeks'))->startOfDay(), 
            $productOption->fresh()->release_date->startOfDay()
        );
    }

    /** @test */
    public function an_option_has_a_property_path()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $category->products()->attach($product->id);
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);

        $this->assertNotNull($productOption->path);
        $this->assertEquals(
            route('shop.products.show', 
                [$productOption->product->categories()->first(), $productOption->product])
            , $productOption->path);
    }

    /** @test */
    public function an_option_has_a_property_thumbnails()
    {
        $product = Product::factory()->create();
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);
        $thumb = ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image_thumb.jpg',
            'full_path' => 'path/image_thumb.jpg',
            'is_thumb' => true,
        ]);

        $this->assertNotNull($productOption->thumbnails);
        $this->assertEquals($thumb->filename, $productOption->thumbnails->first()->filename);
    }

    /** @test */
    public function an_option_has_a_property_real_images()
    {
        $product = Product::factory()->create();
        $productOption = ProductOption::factory()->create(['product_id' => $product->id]);
        $realImage = ImageOption::create([
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

        $this->assertNotNull($productOption->real_images);
        $this->assertEquals($realImage->filename, $productOption->real_images->first()->filename);
    }
    
}
