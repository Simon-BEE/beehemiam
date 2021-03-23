<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Refund;
use App\Services\CollectionPaginatorService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IndexTransactionController extends Controller
{
    public function __invoke(): View
    {
        $transactions = $this->prepareEachTransaction();
        $paymentTransactions = $transactions['payment'];
        $refundTransactions = $transactions['refund'];

        return view('admin.transactions.index', [
            'transactions' => CollectionPaginatorService::paginate(
                $paymentTransactions->merge($refundTransactions),
                15
            ),
        ]);
    }

    private function prepareEachTransaction(): array
    {
        $paymentTransactions = Payment::query();
        $refundTransactions = Refund::query();

        if (request()->get('method')) {
            $paymentTransactions = $this->filterTransactions($paymentTransactions);
            $refundTransactions = $this->filterTransactions($refundTransactions);
        }

        $paymentTransactions = $paymentTransactions->get();
        $refundTransactions = $refundTransactions->get();

        if (request()->get('type') && request()->get('type') !== 'both') {
            $paymentTransactions = request()->get('type') === 'payment' ? $paymentTransactions : collect();
            $refundTransactions = request()->get('type') === 'refund' ? $refundTransactions : collect();
        }

        return ['payment' => $paymentTransactions, 'refund' => $refundTransactions];
    }

    private function filterTransactions(Builder|Model $transactions): Builder|Model
    {
        $searchTerm = request()->get('method');

        $transactions->where('type', 'LIKE', "%$searchTerm%");

        return $transactions;
    }
}
