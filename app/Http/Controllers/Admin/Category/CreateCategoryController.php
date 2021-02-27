<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateCategoryController extends Controller
{
    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request, CategoryRepository $repository): RedirectResponse
    {
        try {
            $repository->save($request->validated());

            return redirect()->route('admin.categories.index')->with([
                'type' => 'Succès',
                'message' => 'La catégorie a bien été créée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
