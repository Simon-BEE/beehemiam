@extends('emails.layouts.layout')

@section('content')
    <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Bonjour, {{ $user->firstname }} !</h1>

    <p style="font-size: 16px; font-weight: bold; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Votre mot de passe vient d'être modifié.</p>
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Nous venons de constater que votre mot de passe vient d'être changé. Si vous êtes à l'origine de cette action vous pouvez ignorer ce message.</p>

    @include('emails.layouts.button', ['link' => 'https://beehemiam.fr', 'text' => 'Se rendre sur Beehemiam.fr'])
    
    <p style="font-size: 16px; line-height: 1.625; color: #51545E; margin: .4em 0 1.1875em;">Si vous n'êtes pas à l'origine de cette action, nous vous prions de nous contacter le plus rapidement possible à cette adresse email <strong>contact@beehemeiam.fr</strong> ou depuis la partie contact du site.</p>
@endsection