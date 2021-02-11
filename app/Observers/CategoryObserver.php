<?php

namespace App\Observers;

use App\Events\CategoryIsRemoved;
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
    public function creating(Category $category): void
    {
        $category->slug = $this->generateSlug($category->name);
    }

    /**
     * Handle the Category "updating" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category): void
    {
        if ($category->getOriginal('name') !== $category->name) {
            $category->slug = $this->generateSlug($category->name);
        }
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @return void
     */
    public function deleted(): void
    {
        CategoryIsRemoved::dispatch();
    }

    /**
     * Generate an unique slug
     *
     * @param string $categoryName
     * @return string
     */
    private function generateSlug(string $categoryName): string
    {
        $count = 0;
        $slug = Str::slug($categoryName);

        while (DB::table('categories')->where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $count++;
        }

        return $slug;
    }
}
