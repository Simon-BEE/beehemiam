<?php

namespace Tests\Feature\Back\Products\Options;

use App\Models\ImageOption;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class OptionImageTest extends TestCase
{
    /** @test */
    public function an_image_can_be_deleted_via_api()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $productOption = ProductOption::factory()->create();
        $img = ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image.jpg',
        ]);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => 'image.jpg',
            'full_path' => 'path/image_thumb.jpg',
            'is_thumb' => true,
        ]);

        $this->delete(route('api.products.options.images.delete', $img))
            ->assertSuccessful();

        $this->assertCount(0, $productOption->images);
    }

    /** @test */
    public function when_an_image_is_deleted_thumb_too_and_in_storage_folder_too()
    {
        Storage::fake('products');

        $productOption = ProductOption::factory()->create();
        $fullPath = 'path/image.jpg';
        $fileName = 'image.jpg';
        $fakeImg = UploadedFile::fake()->image('image.jpg');
        Storage::disk('products')->putFileAs('path', $fakeImg, $fileName);
        Storage::disk('products')->putFileAs('thumbs/path', $fakeImg, $fileName);
        $img = ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => $fileName,
            'full_path' => $fullPath,
            'is_thumb' => false,
        ]);
        ImageOption::create([
            'product_option_id' => $productOption->id,
            'filename' => $fileName,
            'full_path' => 'thumbs/' . $fullPath,
            'is_thumb' => true,
        ]);

        Storage::disk('products')->assertExists($fullPath);
        Storage::disk('products')->assertExists('thumbs/' . $fullPath);

        $img->delete();

        Storage::disk('products')->assertMissing($fullPath);
        Storage::disk('products')->assertMissing('thumbs/' . $fullPath);
    }

}
