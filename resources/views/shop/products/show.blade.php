@extends('layouts.app')

@section('meta-title'){{ $product->name }} &mdash; {{ $category->name }} @endsection

@section('meta-desc'){{ $product->optionDescription }}@endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('shop.categories.index') }}" class="hover:text-primary-600">Toutes les collections</a>
    <span class="text-primary-500">/</span>
    <a href="{{ route('shop.categories.show', $category) }}" class="hover:text-primary-600">{{ $category->name }}</a>
    <span class="text-primary-500">/</span>
    <p>{{ $product->name }}</p>
</section>

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">{{ $product->name }}</h1>
    </article>

    @livewire('shop.products.show', ['product' => $product], key($product->id))
</section>

@endsection