<?php

namespace App\Http\Livewire\Shop\Products;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Collection;
use Livewire\Component;

class Show extends Component
{
    public Product $product;
    public Collection $productOptions;
    public ProductOption $currentOption;

    public function mount()
    {
        $this->productOptions = $this->product->productOptions;
        $this->currentOption = $this->product->firstProductOption();
    }

    public function render()
    {
        return view('livewire.shop.products.show');
    }
}
