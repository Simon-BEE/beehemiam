<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Beehemiam &mdash; Facture n°{{ $order->id }} &mdash; {{ $order->created_at->format('d/m/Y') }}</title>
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

        main {
            min-height: 100%;
            width: 100%;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #757459;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 19cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 3em;
            border-bottom: 1px solid #DDD;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            /* float: right; */
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 1em;
            border-left: 6px solid #757459;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        #client .address {
            margin: 2px 0;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: bold;
            margin: 2px 0 0 0;
        }

        #invoice {
            /* float: right; */
            text-align: right;
        }

        #invoice h1 {
            color: #757459;
            font-size: 2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 5px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: bold;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #757459;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table td.desc {
            text-align: left;
            width: 35%;
        }

        table .unit {
            background: #DDDDDD;
            width: 25%;
        }

        table .qty {
            background: #fafafa;
            width: 15%;
            text-align: center;
        }

        table .total {
            background: #757459;
            color: #FFFFFF;
            width: 25%;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #757459;
            font-size: 1.4em;
            border-top: 1px solid #757459;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        table tfoot .taxes td{
            color: #777;
        }

        #notices {
            padding-left: 1em;
            border-left: 6px solid #757459;
            margin-top: 5em;
        }

        #notices h2 {
            margin: 0 0 2px 0;
            font-size: 1em;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 100px;
            margin-top: auto;
            border-top: 1px solid #DDD;
            padding: 8px 0;
            text-align: center;
        }

        footer p {
            margin: .5em;
        }

    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="https://beehemiam.fr/logo-mini-color-2.png">
        </div>
        <div id="company">
            <h2 class="name">BEEHEMIAM</h2>
            <div>3 route de la bergerette, Terjat 03420, France</div>
            <div>0611984533</div>
            <div><a href="mailto:contact@beehemiam.fr">contact@beehemiam.fr</a></div>
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Facture émise à</div>
                <h2 class="name">{{ $order->invoice->address->full_name }}</h2>
                <div class="address">{{ $order->invoice->address->inline_address }}</div>
                <div class="email"><a href="mailto:{{ $order->invoice->address->invoice_email }}">{{ $order->invoice->address->invoice_email }}</a></div>
            </div>
            <div id="invoice">
                <h1>Facture n°{{ $order->id }}</h1>
                <div class="date">créée le {{ $order->created_at->format('d/m/Y') }}</div>
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
                        <td class="total">{{ $item->formatted_price_without_taxes * $item->quantity }}€</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="1">Sous-total HT</td>
                    <td>{{ $order->formatted_price_without_taxes }}€</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="1">Frais de port HT</td>
                    <td>{{ $order->shipping_fees_without_taxes }}€</td>
                </tr>
                <tr class="taxes">
                    <td colspan="2"></td>
                    <td colspan="1">TVA</td>
                    <td>{{ $order->formatted_total_taxes }}€</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="1">Montant total TTC</td>
                    <td>{{ $order->formatted_price }}€</td>
                </tr>
            </tfoot>
        </table>

        <div id="notices">
            <h2>Informations complémentaires:</h2>
            <p class="notice">{{ $order->has_preorder ? "Contient des articles en précommande, la livraison s'effectuera dès la fin des précommandes de ces articles." : "La commande sera expédiée dans les meilleurs délais." }}</p>
        </div>
    </main>
    <footer>
        <p><strong>Beehemiam</strong> &mdash; <strong>Adresse email</strong> contact@beehememiam.fr &mdash; <strong>Téléphone</strong> 0611984533</p>
        <p><strong>Siret</strong> 456987456 &mdash; <strong>TVA</strong> 145639</p>
        <p><strong>Adresse postale</strong> 3 route de la bergerette, Terjat 03420, France</p>
    </footer>
</body>

</html>
