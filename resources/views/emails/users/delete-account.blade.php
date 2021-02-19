@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour, {{ $user->firstname }} !</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Vous avez fait une demande de suppression de votre compte sur Beehemiam.fr.</p>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Si vous êtes bien à l'origine de cette demande, et souhaitez confirmer cette action, vous êtes invité à cliquer sur le bouton ci-dessous. Toutes vos données seront immédiatement supprimées et nous ne serons pas en mesure de les récupérer si nécessaire.</p>

    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; margin: 30px auto; padding: 0;">
        <tr>
          <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
              <tr>
                <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                  <a href="{{ route('user.settings.delete-account', $user) }}" class="f-fallback button" target="_blank" style="color: #FFF; border-color: #E4A075; border-style: solid; border-width: 10px 18px; background-color: #E4A075; display: inline-block; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">Supprimer mon compte Beehemiam</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">En espérant vous retrouver très vite sur le site ou d'autres plateformes.</p>
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">À bientôt, toute l'équipe Beehemiam.</p>
@endsection