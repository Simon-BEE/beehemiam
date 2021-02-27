<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Repositories\Coupon\CouponRepository;
use Exception;
use Illuminate\Http\RedirectResponse;

class DeleteCouponController extends Controller
{
    public function __invoke(CouponRepository $repository, Coupon $coupon): RedirectResponse
    {
        if ($coupon->orders->isNotEmpty()) {
            return redirect()->route('admin.discount.index')->with([
                'type' => 'Erreur',
                'message' => 'Le code de réduction ne peut pas être supprimé !',
            ]);
        }

        try {
            $repository->delete($coupon);

            return redirect()->route('admin.discount.index')->with([
                'type' => 'Succès',
                'message' => 'Le code de réduction a bien été supprimé !',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
