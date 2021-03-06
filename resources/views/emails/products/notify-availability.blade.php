@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour {{ $user?->firstname }},</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Nous avons le plaisir de vous informer, que le vêtement <strong>{{ $productOption->name }}</strong> est désormais disponible sur Beehemiam.fr.</p>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Vous recevez cet email, car il y a quelques temps, vous nous avez indiqué que vous voudriez être au courant de la nouvelle disponibilité de ce vêtement.</p>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Vous pouvez désormais consulter sa fiche produit et même passer commande. Les stocks sont limités, profitez-en !</p>

    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;">
        <tr>
          <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
              <tr>
                <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                  <a href="{{ $productOption->path }}" class="f-fallback button" target="_blank" style="color: #FFF; border-color: #E4A075; border-style: solid; border-width: 10px 18px; background-color: #E4A075; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Voir {{ $productOption->name }} dans la boutique</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">En espérant vous retrouver très vite sur le site.</p>
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">À bientôt, toute l'équipe Beehemiam.</p>
@endsection