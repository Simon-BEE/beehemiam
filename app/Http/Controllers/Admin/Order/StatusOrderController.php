<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StatusOrderController extends Controller
{
    public function show(Order $order): RedirectResponse|View
    {
        return view('admin.orders.status', [
            'order' => $order->load('status'),
            'status' => OrderStatus::all(),
        ]);
    }
}
