<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IndexOrderController extends Controller
{
    public function __invoke(FilterOrderRequest $request): View
    {
        $orders = Order::query();

        if ($request->get('order_id') || $request->get('order_status_id')) {
            $orders = $this->filterOrders($orders);
        }

        return view('admin.orders.index', [
            'orders' => $orders->with(['status'])
                ->withCount('orderItems')
                ->latest()
                ->paginate(),
            'status' => OrderStatus::all(),
        ]);
    }

    private function filterOrders(Builder|Model $orders): Builder|Model
    {
        $orders->when(request()->get('order_id'), function ($query) {
                    return $query->where('id', request()->get('order_id'));
        })
                ->when(request()->get('order_status_id'), function ($query) {
                    return $query->whereHas('status', function ($query) {
                        return $query->where('id', request()->get('order_status_id'));
                    });
                });

        return $orders;
    }
}
