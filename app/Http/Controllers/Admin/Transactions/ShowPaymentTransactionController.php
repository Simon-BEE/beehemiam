<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Contracts\View\View;

class ShowPaymentTransactionController extends Controller
{
    public function __invoke(Payment $payment): View
    {
        return view('admin.transactions.show', [
            'transaction' => $payment->load('order'),
        ]);
    }
}
