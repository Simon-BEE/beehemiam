@extends('layouts.invoice')

@section('meta-title')
    Facture n°{{ $reference }} &mdash; {{ $order->created_at->format('d/m/Y') }}
@endsection

@section('content')
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Facture émise à</div>
                <h2 class="name">{{ $address->full_name }}</h2>
                <div class="address">{{ $address->inline_address }}</div>
                <div class="email"><a href="mailto:{{ $address->invoice_email }}">{{ $address->invoice_email }}</a></div>
            </div>
            <div id="invoice">
                <h1>Facture n°{{ $reference }}</h1>
                <div class="date">du {{ $order->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="qty">Quantité</th>
                    <th class="desc">Description</th>
                    <th class="unit">Prix Unitaire HT</th>
                    <th class="total">Prix Total HT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td class="qty">{{ $item->quantity }}</td>
                        <td class="desc">
                            <h3>{{ $item->name }} {{ $item->is_preorder ? '(en précommande)' : '' }}</h3>
                            Taille {{ $item->size->name }}
                        </td>
                        <td class="unit">{{ $item->formatted_price_without_taxes }}€</td>
                        <td class="total">{{ $item->formatted_total_price }}€</td>
                    </tr>
                @endforeach
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
                @if ($order->coupons->isNotEmpty())
                    @foreach ($order->coupons as $coupon)
                        <tr>
                            <td class="without_border" colspan="2"></td>
                            <td class="total_amount" colspan="1">Réduction <span style="font-size: .6em">({{ $coupon->code }})</span></td>
                            <td class="total_amount">-{{ $coupon->amount }}€</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td class="without_border" colspan="2"></td>
                    <td colspan="1">Sous-total HT</td>
                    <td>{{ $order->formatted_price_without_taxes }}€</td>
                </tr>
                <tr>
                    <td class="without_border" colspan="2"></td>
                    <td colspan="1">Frais de port HT</td>
                    <td>{{ $order->shipping_fees_without_taxes }}€</td>
                </tr>
                <tr class="taxes">
                    <td class="without_border" colspan="2"></td>
                    <td colspan="1">TVA</td>
                    <td>{{ $order->formatted_total_taxes }}€</td>
                </tr>
                <tr>
                    <td class="without_border" colspan="2"></td>
                    <td class="total_amount" colspan="1">Montant total TTC</td>
                    <td class="total_amount">{{ $order->formatted_price }}€</td>
                </tr>
            </tbody>
        </table>

        <div id="notices">
            <h2>Informations complémentaires:</h2>
            <p class="notice">{{ $order->has_preorder ? "Contient des articles en précommande, la livraison s'effectuera dès la fin des précommandes de ces articles." : "La commande sera expédiée dans les meilleurs délais." }}</p>
        </div>
    </main>
@endsection
