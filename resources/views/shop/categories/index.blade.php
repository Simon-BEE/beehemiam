@extends('layouts.app')

@section('meta-title')
    La boutique
@endsection

@section('meta-desc')
    Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour tous les goûts !
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-16 md:mb-32">
        <h1 class="text-5xl md:text-7xl font-cursive">Qu'est-ce qui vous fait le plus envie ?</h1>
        <p class="mt-8">Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour chacune d'entre vous !</p>
    </article>

    <section class="w-full md:p-0 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-16">
        @forelse ($categories as $category)
            <a href="{{ route('shop.categories.show', $category) }}" class="flex flex-col justify-between transform transition-transform duration-500 hover:scale-105 relative">
                {{-- <img src="{{ $category->image }}" alt="{{ $category->name }} image" class="w-full rounded shadow-xl"> --}}
                <img src="https://source.unsplash.com/500x600/weekly?boho" alt="{{ $category->name }} image" class="w-full rounded shadow-xl">
                <div class="absolute inset-0 bg-black bg-opacity-25 text-white flex flex-col items-center justify-center">
                    <h4 class="text-4xl font-bold">{{ $category->name }}</h4>
                    <p class="hidden md:block w-1/2 text-center">{{ substr($category->description, 0, 30) }}...</p>
                </div>
                <p class="absolute bottom-0 rounded-xl bg-white bg-opacity-50 px-3 py-2 w-11/12 mx-3 my-5 text-center font-semibold text-gray-700">
                    {{ $category->products_count }} produit{{ $category->products_count > 1 ? 's' : '' }}
                </p>
            </a>
        @empty
            <p class="text-2xl font-semibold text-center w-full"><strong>Oups!</strong> Aucun produit disponible à la vente 😶</p>
        @endforelse
    </section>
</section>

@endsection