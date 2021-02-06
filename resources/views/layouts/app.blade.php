<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 p-12">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid inventore obcaecati reprehenderit quaerat fugit deserunt, nesciunt labore molestias deleniti rem minima? Dicta aperiam quam, harum eaque illum natus? Veritatis sint ea quos voluptatem similique, beatae reprehenderit voluptates, soluta, harum ratione corrupti omnis aliquid sunt quisquam quae consectetur consequatur iure quidem ut recusandae quis odit dolorem? Neque dignissimos fugit pariatur, soluta reiciendis, est in aperiam vero, libero iure magnam. Veritatis temporibus facere praesentium illo itaque maxime aspernatur dignissimos eos maiores magni iste, reprehenderit perspiciatis vitae earum ducimus doloribus ipsum necessitatibus. Minima suscipit aperiam eum amet illo nobis error hic et magni.
        </div>
    </body>
</html>
