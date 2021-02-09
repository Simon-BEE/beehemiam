<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    public function store(array $validatedData): Category
    {
        $category = Category::create($validatedData);

        return $category;
    }
}
