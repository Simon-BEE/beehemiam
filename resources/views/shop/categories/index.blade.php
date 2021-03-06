@extends('layouts.app')

@section('meta-title')
    La boutique
@endsection

@section('meta-desc')
    Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour tous les goûts !
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Qu'est-ce qui vous fait le plus envie ?</h1>
        <p class="mt-8">Découvrez l'ensemble des vêtements proposés par Beehemiam. Des robes courtes, longues, des blouses, des pantalons, il y en a pour chacune d'entre vous !</p>
    </article>

    <form method="GET" action="{{ route('shop.search.index') }}" class="mb-8 md:mb-16">
        <div class="flex items-center justify-between">
            <x-form.input
                name="q"
                label=""
                placeholder="Rechercher un vêtement"
                required
            />

            <x-form.button class="bg-primary-500 text-white  hover:bg-primary-400 font-semibold -mt-2 ml-3">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                </svg>
                Rechercher
            </x-form.button>
        </div>
    </form>

    <section class="w-full md:p-0 {{ $categories->count() > 1 ? 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-16' : 'flex items-center justify-center' }}">
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
            <p class="text-2xl inline mx-auto font-semibold text-center px-8 py-12 rounded bg-primary-700"><strong>Oups!</strong> Aucun produit disponible à la vente 😶</p>
        @endforelse
    </section>
</section>

@endsection