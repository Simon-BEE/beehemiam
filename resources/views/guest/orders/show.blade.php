@extends('layouts.app')

@section('meta-title')Ma commande n°{{ $order->id }} @endsection

@section('content')

<section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('welcome') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Accueil</a>
    <span class="text-gray-500">/</span>
    <a href="{{ route('shop.categories.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">La boutique</a>
    <span class="text-gray-500">/</span>
    <p>Commande n°{{ $order->id }}</p>
</section>

@include('orders.show')

@endsection
