<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Contracts\View\View;

class IndexDiscountController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.discount.index', [
            'coupons' => Coupon::paginate(),
        ]);
    }
}
