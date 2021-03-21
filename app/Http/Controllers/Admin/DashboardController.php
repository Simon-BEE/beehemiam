<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'clients_count' => User::clients()->count(),
            'orders_count' => Order::processed()->count(),
            'preorders_count' => Order::preOrders()->count(),
            'total_incomes' => number_format(Order::select(['id', 'price'])->processed()->get()->sum('price') / 100, 2),
            'stock_products' => Product::lowStock()->take(5),
            'latest_orders' => Order::latest()->withCount('orderItems')->take(5)->get(),
            'latest_users' => User::clients()->latest()->take(5)->get(),
        ]);
    }
}
