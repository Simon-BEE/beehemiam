<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use App\Repositories\Coupon\CouponRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditCouponController extends Controller
{
    public function edit(Coupon $coupon): View
    {
        return view('admin.discount.coupons.edit', [
            'coupon' => $coupon,
        ]);
    }

    public function update(CouponRequest $request, CouponRepository $repository, Coupon $coupon): RedirectResponse
    {
        try {
            $repository->update($coupon, $request->validated());

            return redirect()->route('admin.discount.index')->with([
                'type' => 'Succès',
                'message' => 'Le code de réduction a bien été modifié !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
