@extends('layouts.app')

@section('meta-title')
    Commande n°{{ $order->id }}
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <a href="{{ route('user.orders.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon historique de commande</a>
        <span class="text-gray-500">/</span>
        <p>Commande n°{{ $order->id }}</p>
    </section>

    @include('orders.show')
</x-layouts.user>

@endsection

