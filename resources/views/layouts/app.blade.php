<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="keywords" content="vêtements, allaitement, éthiques, naturels, écologique, bébé, maternel, maternelle"/>

        @hasSection ('meta-desc')
        <meta name="description" content="@yield('meta-desc')"/>
        <meta name="og:description" content="@yield('meta-desc')"/>
        @else
        <meta name="description" content="Une marque de vêtements d'allaitement éthiques, à prix raisonnable, pour allaiter confortablement en toute circonstance votre bébé."/>
        <meta name="og:description" content="Une marque de vêtements d'allaitement éthiques, à prix raisonnable, pour allaiter confortablement en toute circonstance votre bébé."/>
        @endif

        <meta name="copyright"content="Beehemiam">
        <meta name="language" content="FR">
        <meta name="robots" content="index,follow" />
        <meta name="author" content="Simon BÉE, contact@skymon.fr">
        <meta name="url" content="https://beehemiam.fr">
        <meta name="identifier-URL" content="https://beehemiam.fr">
        <meta name="revisit-after" content="7 days">

        <meta name="og:title" content="Beehemiam.fr &mdash; Vêtements d'allaitement"/>
        <meta name="og:url" content="https://beehemiam.fr"/>
        <meta name="og:image" content="https://beehemiam.fr/screenshot.png"/>

        <link rel="icon" href="/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/favicons/site.webmanifest">

        <title>{{ config('app.name') }} @hasSection ('meta-title') &mdash; @yield('meta-title') @endif</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 p-12">
            @yield('content')
        </div>
    </body>
</html>
