<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug = $this->generateSlug($category);
    }

    /**
     * Generate an unique slug
     *
     * @param Category $product
     * @return string
     */
    private function generateSlug(Category $category): string
    {
        $count = 0;
        $slug = Str::slug($category->name);

        while (DB::table('categories')->where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $count++;
        }

        return $slug;
    }
}
