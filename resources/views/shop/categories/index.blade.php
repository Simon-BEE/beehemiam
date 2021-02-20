@extends('layouts.app')

@section('meta-title')
    La boutique
@endsection

@section('meta-desc')
    Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour tous les goûts !
@endsection

@section('content')

<section class="flex flex-col items-center justify-center">
    <article class="w-full md:w-1/2 text-center mb-32">
        <h1 class="text-5xl md:text-7xl font-cursive">Qu'est-ce qui vous fait le plus envie ?</h1>
        <p class="mt-8">Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour chacune d'entre vous !</p>
    </article>

    <section class="w-full flex flex-col md:flex-row md:flex-wrap md:justify-between items-center space-y-5">
        @forelse ($categories as $category)
            <a href="#" class="flex w-11/12 md:w-47p transform transition-transform duration-500 hover:scale-105 relative">
                <img src="https://source.unsplash.com/800x600/weekly?boho" alt="{{ $category->name }} image" class="w-full rounded shadow-xl">
                <div class="absolute inset-0 bg-black bg-opacity-25 text-white flex flex-col items-center justify-center">
                    <h4 class="text-4xl font-bold">{{ $category->name }}</h4>
                    <p class="hidden md:block w-1/2 text-center">{{ $category->description }}</p>
                </div>
            </a>
        @empty
            <p class="text-2xl font-semibold text-center w-full"><strong>Oups!</strong> Aucun produit disponible à la vente 😶</p>
        @endforelse
    </section>
</section>

@endsection