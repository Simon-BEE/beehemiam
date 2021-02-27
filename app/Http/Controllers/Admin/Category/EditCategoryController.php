<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditCategoryController extends Controller
{
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(
        StoreCategoryRequest $request,
        CategoryRepository $repository,
        Category $category
    ): RedirectResponse {
        try {
            $repository->update($category, $request->validated());

            return redirect()->route('admin.categories.index')->with([
                'type' => 'Succès',
                'message' => 'La catégorie a bien été modifiée !',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
