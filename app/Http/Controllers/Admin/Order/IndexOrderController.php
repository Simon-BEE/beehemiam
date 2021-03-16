<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class IndexOrderController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.orders.index', [
            'orders' => Order::with(['status'])
                ->withCount('orderItems')
                ->latest()
                ->paginate(),
        ]);
    }
}
