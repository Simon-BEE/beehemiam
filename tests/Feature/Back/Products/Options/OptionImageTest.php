<?php

namespace Tests\Feature\Back\Products\Options;

use App\Models\ImageOption;
use App\Models\ProductOption;
use App\Models\User;
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
    
}
