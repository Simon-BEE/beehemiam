@extends('layouts.app')

@section('meta-title'){{ $category->name }} &mdash; Les vêtements @endsection

@section('meta-desc'){{ $category->description }}@endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('shop.categories.index') }}" class="hover:text-primary-600">Toutes les collections</a>
    <span class="text-primary-500">/</span>
    <p>{{ $category->name }}</p>
</section>

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-16 md:mb-32">
        <h1 class="text-5xl md:text-7xl font-cursive">{{ $category->name }}</h1>
        <p class="mt-8">{{ $category->description }}</p>
    </article>

    <section class="w-full md:p-0 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-16">
        @forelse ($products as $product)
            @include('shop.products.card', ['product' => $product])
        @empty
            <p class="text-2xl font-semibold text-center w-full"><strong>Oups!</strong> Aucun produit disponible à la vente 😶</p>
        @endforelse
    </section>
</section>

@endsection