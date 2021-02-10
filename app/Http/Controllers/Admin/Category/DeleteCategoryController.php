<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\RedirectResponse;

class DeleteCategoryController extends Controller
{
    public function __invoke(CategoryRepository $repository, Category $category): RedirectResponse
    {
        try {
            $repository->delete($category);

            return redirect()->route('admin.categories.index')->with([
                'type' => 'Succès',
                'message' => 'La catégorie a bien été supprimée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
