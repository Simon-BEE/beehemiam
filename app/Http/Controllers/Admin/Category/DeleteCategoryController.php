<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;

class DeleteCategoryController extends Controller
{
    public function __invoke(CategoryRepository $repository, Category $category)
    {
        try {
            $repository->delete($category);

            return redirect()->route('admin.categories.index')->with([
                'type' => 'success',
                'message' => 'La catégorie a bien été supprimée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
