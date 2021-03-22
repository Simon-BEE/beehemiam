@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour,</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Voici une copie du message que vous venez d'envoyer depuis le formulaire de contact du site <a href="{{ url('/') }}" style="color: #E4A075;">Beehemiam.fr</a>.</p>

    <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;">
        <tr>
            <td class="attributes_content" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                            {!! nl2br($content) !!}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @include('emails.layouts.button', ['link' => 'https://beehemiam.fr', 'text' => 'Se rendre sur Beehemiam.fr'])

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Nous essayons de répondre à tous les messages dans les meilleurs délais. En général vous obtiendrez une réponse sous <strong>2 jours ouvrés</strong>.</p>

@endsection
