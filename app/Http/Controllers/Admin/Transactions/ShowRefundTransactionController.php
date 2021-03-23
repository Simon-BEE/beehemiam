<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Contracts\View\View;

class ShowRefundTransactionController extends Controller
{
    public function __invoke(Refund $refund): View
    {
        return view('admin.transactions.show', [
            'transaction' => $refund->load('order'),
        ]);
    }
}
