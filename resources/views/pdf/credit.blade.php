@extends('layouts.invoice')

@section('meta-title')
    Avoir n°{{ $reference }} &mdash; {{ $refund->created_at->format('d/m/Y') }}
@endsection

@section('content')
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Avoir émis à</div>
                <h2 class="name">{{ $refund->order->invoice->address->full_name }}</h2>
                <div class="address">{{ $refund->order->invoice->address->inline_address }}</div>
                <div class="email"><a href="mailto:{{ $refund->order->invoice->address->invoice_email }}">{{ $refund->order->invoice->address->invoice_email }}</a></div>
            </div>
            <div id="invoice">
                <h1>Avoir n°{{ $reference }}</h1>
                <div class="date">en rapport à la facture n°{{ $refund->order->invoice->reference }}</div>
                <div class="date">du {{ $refund->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="qty">Date</th>
                    <th class="desc">Montant de l'avoir TTC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="qty">{{ $refund->created_at->format('d/m/Y') }}</td>
                    <td class="desc">{{ $refund->formatted_amount }}€</td>
                </tr>
            </tbody>
        </table>
        <table class="info" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th style="width: 25%"></th>
                    <th style="width: 25%"></th>
                    <th style="width: 25%"></th>
                    <th style="width: 25%"></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="without_border" colspan="2"></td>
                    <td class="total_amount" colspan="1">Montant total TTC</td>
                    <td class="total_amount">{{ $refund->formatted_amount }}€</td>
                </tr>
            </tbody>
        </table>

        <div id="notices">
            <h2>Informations complémentaires:</h2>
            <p class="notice">Remboursement effectué sur la commande n°{{ $refund->order->id }}.</p>
        </div>
    </main>
@endsection
