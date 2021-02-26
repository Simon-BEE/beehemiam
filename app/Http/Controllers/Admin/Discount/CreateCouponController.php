<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Repositories\CouponRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CreateCouponController extends Controller
{
    public function create(): View
    {
        return view('admin.discount.coupons.create');
    }

    public function store(CouponRequest $request, CouponRepository $repository): RedirectResponse
    {
        try {
            $repository->save($request->validated());

            return redirect()->route('admin.discount.index')->with([
                'type' => 'Succès',
                'message' => 'Le code de réduction a bien été créé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
