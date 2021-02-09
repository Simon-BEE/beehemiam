<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Repositories\Category\CategoryRepository;

class CreateCategoryController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request, CategoryRepository $repository)
    {
        try {
            $repository->store($request->validated());

            return back()->with([
                'type' => 'success',
                'message' => 'La catégorie a bien été créée !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
