@extends('layouts.app')
    
@section('meta-title')
    @yield('title')
@endsection

@section('content')

    <section class="flex flex-col items-center justify-center">
        <h2 class="text-9xl font-cursive">@yield('code')</h2>

        <p class="text-3xl">@yield('message')</p>

        <p class="mt-8">
            <a href="{{ route('welcome') }}" class="relative nav-link text-primary-500 flex p-4">Retourner à la page d'accueil</a>
        </p>
    </section>

@endsection