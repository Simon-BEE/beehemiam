@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour,</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Un nouveau message vient d'être envoyé depuis le formulaire de contact du site.</p>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">L'utilisateur a indiqué utiliser cette adresse email <strong>{{ $email }}</strong>, et vous contacte au sujet de <strong>{{ $object }}</strong>.</p>

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

@endsection
