@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #51545E;; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour,</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Nous avons le plaisir de vous informer que votre commande sur <strong>Beehemiam.fr</strong> a bien été reçue.</p>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Cette commande <strong>n°{{ $order->id }}</strong> d'un montant de <strong>{{ $order->formatted_price }}€</strong> est en {{ $verboseStatus }}. Vous recevrez un nouvel email dès lors que celle-ci sera expédiée.</p>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Voici un récapitulatif de votre commande :</p>

    {{-- ORDER ITEMS --}}
    <table width="100%" style="background-color: #F4F4F7;padding.5em;margin-bottom:1.5em;">
        <thead>
            <tr>
              <th scope="col" style="padding-top:.5em;">Nom du produit</th>
              <th scope="col" style="padding-top:.5em;">Quantité</th>
              <th scope="col" style="padding-top:.5em;">Sous Total TTC</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orderItems as $item)
                <tr>
                    <td style="padding-top:.5em;text-align:center" data-label="Nom">{{ $item->name }}</td>
                    <td style="padding-top:.5em;text-align:center" data-label="Quantité">{{ $item->quantity }}</td>
                    <td style="padding-top:.5em;text-align:center" data-label="Prix">{{ $item->formatted_price }}€</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="padding:.5em"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding:.5em;border-top:1px solid #ccc"></td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight:bold;padding:.2em .5em;text-align:right">Frais de port TTC</td>
                <td colspan="1" style="font-weight:bold;padding:.2em .5em;text-align:center">{{ $order->shipping_fees / 100 }}€</td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight:bold;padding:.2em .5em;text-align:right">Total payé TTC</td>
                <td colspan="1" style="font-weight:bold;padding:.2em .5em;text-align:center">{{ $order->formatted_price }}€</td>
            </tr>
          </tbody>
    </table>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">La commande sera livrée à l'adresse suivante : </p>

    <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;">
        <tr>
            <td class="attributes_content" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                        {{ $address->street }}, {{ $address->city }} {{ $address->zipcode }}, {{ $address->country->name }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;">
        <tr>
          <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
              <tr>
                <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                  <a href="{{ $order->path }}" class="f-fallback button" target="_blank" style="color: #FFF; border-color: #E4A075; border-style: solid; border-width: 10px 18px; background-color: #E4A075; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Voir le recapitulatif de la commande sur Beehemiam.fr</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">En espérant vous retrouver très vite sur le site.</p>
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">À bientôt, toute l'équipe <a href="{{ url('/') }}" style="font-weight: bold;text-decoration:none;color:#51545E;">Beehemiam</a>.</p>
@endsection
