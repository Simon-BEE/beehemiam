<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(4)->create();

        $categories->each(function ($category) {
            $products = Product::factory()->active()->count(mt_rand(3, 5))->create();

            $products->each(function ($product) use ($category) {
                $category->products()->attach($product->id);

                $productOptions = ProductOption::factory()->count(mt_rand(1, 3))->create([
                    'product_id' => $product->id,
                ]);

                $productOptions->each(function ($productOption) {
                    $productOption->images()->create([
                        'filename' => 'image.jpg',
                        'full_path' => 'x/image.jpg',
                    ]);
                    $productOption->images()->create([
                        'filename' => 'image.jpg',
                        'full_path' => 'thumbs/x/image.jpg',
                        'is_thumb' => true,
                    ]);

                    $productOption->sizes()->create([
                        'size_id' => mt_rand(1, 3),
                        'quantity' => mt_rand(10, 50),
                    ]);

                    $productOption->sizes()->create([
                        'size_id' => mt_rand(4, 7),
                        'quantity' => mt_rand(10, 50),
                    ]);
                });
            });
        });

    }
}
