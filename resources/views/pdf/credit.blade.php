@extends('layouts.invoice')

@section('meta-title')
    Avoir n°{{ $reference }} &mdash; {{ $refund->created_at->format('d/m/Y') }}
@endsection

@section('content')
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Avoir émis à</div>
                <h2 class="name">{{ $address->full_name }}</h2>
                <div class="address">{{ $address->inline_address }}</div>
                <div class="email"><a href="mailto:{{ $address->invoice_email }}">{{ $address->invoice_email }}</a></div>
            </div>
            <div id="invoice">
                <h1>Avoir n°{{ $reference }}</h1>
                <div class="date">du {{ $order->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="qty"></th>
                    <th class="desc">Montant de l'avoir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="qty"></td>
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
