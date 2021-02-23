<?php

namespace App\Repositories\Shop\Cart;

use App\Models\ProductOptionSize;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepository
{
    public function add(ProductOptionSize $productOptionSize)
    {
        Cart::add($productOptionSize->id , $productOptionSize->productOption->name, 1, $productOptionSize->productOption->price);
    }
}
