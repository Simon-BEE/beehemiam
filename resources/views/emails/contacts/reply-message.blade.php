@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour,</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Vous venez de recevoir une réponse à votre message envoyé depuis le formulaire du site <strong>Beehemiam.fr</strong>.</p>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">La réponse à votre message :</p>

    <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;">
        <tr>
            <td class="attributes_content" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                            {!! nl2br($reply->content) !!}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Votre message initial :</p>

    <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;">
        <tr>
            <td class="attributes_content" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="attributes_item" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                            {!! nl2br($reply->original->content) !!}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @include('emails.layouts.button', ['link' => 'https://beehemiam.fr', 'text' => 'Se rendre sur Beehemiam.fr'])

@endsection
