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

    public function update(Category $category, array $validatedData): Category
    {
        return tap($category)->update($validatedData);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
