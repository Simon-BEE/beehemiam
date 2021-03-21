<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refund;
use App\Services\CollectionPaginatorService;
use Illuminate\Contracts\View\View;

class IndexTransactionController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.transactions.index', [
            'transactions' => CollectionPaginatorService::paginate(
                Payment::all()->merge(Refund::all()),
                15
            ),
        ]);
    }
}
