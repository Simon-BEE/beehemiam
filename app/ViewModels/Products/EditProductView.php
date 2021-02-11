<?php

namespace App\ViewModels\Products;

use App\Models\Product;
use App\ViewModels\ViewModelInterface;
use Illuminate\Support\Collection;

class EditProductView implements ViewModelInterface
{
    private Product $product;

    public string $name;
    public bool $is_preorder;
    public bool $is_active;
    public Collection $categories;
    public Collection $options;
    public string $updateRoute;
    public string $deleteRoute;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function get(): self
    {
        $this->prepare();

        return $this;
    }

    private function prepare(): void
    {
        $this->name = $this->product->name;
        $this->is_preorder = $this->product->is_preorder;
        $this->is_active = $this->product->is_active;
        $this->categories = $this->product->categories;
        $this->options = $this->product->productOptions;
        $this->updateRoute = route('admin.products.update', $this->product);
        $this->deleteRoute = '';
    }
}
