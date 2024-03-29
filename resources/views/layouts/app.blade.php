<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords"
        content="vêtements, allaitement, éthiques, naturels, écologique, bébé, maternel, maternelle" />

    <title>{{ config('app.name') }} @hasSection ('meta-title') &mdash; @yield('meta-title') @endif</title>

    @hasSection ('meta-desc')
        <meta name="description" content="@yield('meta-desc')" />
        <meta name="og:description" content="@yield('meta-desc')" />
    @else
        <meta name="description"
            content="Une marque de vêtements d'allaitement éthiques, à prix raisonnable, pour allaiter confortablement en toute circonstance votre bébé." />
        <meta name="og:description"
            content="Une marque de vêtements d'allaitement éthiques, à prix raisonnable, pour allaiter confortablement en toute circonstance votre bébé." />
    @endif

    <meta name="copyright" content="Beehemiam">
    <meta name="language" content="FR">
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Simon BÉE, contact@skymon.fr">
    <meta name="url" content="https://beehemiam.fr">
    <meta name="identifier-URL" content="https://beehemiam.fr">
    <meta name="revisit-after" content="7 days">

    <meta name="og:title" content="Beehemiam.fr &mdash; Vêtements d'allaitement" />
    <meta name="og:url" content="https://beehemiam.fr" />
    <meta name="og:image" content="https://beehemiam.fr/screenshot.png" />

    <link rel="icon" href="/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-nunito bg-primary-100 text-kaki-900 overflow-x-hidden">

    <section class="alert-container fixed bottom-2 right-2 z-20 mx-2 min-w-3/4 md:min-w-1/4 max-w-screen-sm">
        @if (session()->has('type') && session()->has('message'))
            <x-alert />
        @endif
    </section>

<div class="wrapper relative container mx-auto md:py-4" id="app">

    <overlay-background></overlay-background>

    @stack('modal')

    @include('layouts.front.header')

    <main class="my-12 md:my-24">

        @yield('content')

    </main>

    <cookie-banner>
        <p class="md:max-w-4xl text-center">Le site <strong>Beehemiam.fr</strong> n'utilise aucun cookie servant à stocker des informations sur vous ou vos habitudes numériques, seulement à des fins utiles au bon fonctionnement du site (le panier par exemple). <a href="{{ route('pages.privacy-policy') }}" class="font-bold underline">En savoir plus...</a></p>
    </cookie-banner>
</div>

    @include('layouts.front.footer')


    @stack('scripts')

</body>

</html>
