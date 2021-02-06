<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} @hasSection ('meta-title') &mdash; @yield('meta-title') @endif</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/guest.js') }}" defer></script>

    <style>
        .auth-pattern{
            background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%,rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%,rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%,rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%,rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%,rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%),linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(80, 80, 80, 0.03) 11%,rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%,rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%,rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%,rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%,rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%),linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%,rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%,rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%,rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%,rgba(5, 5, 5, 0.03) 83%, rgba(5, 5, 5, 0.03) 84%,rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%),linear-gradient(90deg, #ffffff,#ffffff);
        }
    </style>
</head>

<body>

    <main class="w-screen min-h-screen py-4 flex justify-center items-center relative auth-pattern">

        <p class="absolute top-2 left-3">
            <a href="{{ route('welcome') }}" class="p-3 flex items-center text-sm uppercase font-bold text-gray-600 hover:bg-gray-100">
                <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18.41,7.41L17,6L11,12L17,18L18.41,16.59L13.83,12L18.41,7.41M12.41,7.41L11,6L5,12L11,18L12.41,16.59L7.83,12L12.41,7.41Z" />
                </svg>
                Retourner à l'accueil
            </a>
        </p>

        <section class="flex flex-col items-center md:flex-row w-10/12 md:w-1/2 bg-white rounded-2xl shadow-lg mt-16 md:mt-0">
            @yield('content')
        </section>
    </main>
    
</body>

</html>