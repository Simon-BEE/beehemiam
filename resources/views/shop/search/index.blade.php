@extends('layouts.app')

@section('meta-title')Recherche de vêtements @endsection

@section('meta-desc')Rechercher dans la boutique quel est le vêtement qu'il vous faut ! @endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center md:justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('shop.categories.index') }}" class="hover:text-primary-600">Toutes les collections</a>
    <span class="text-primary-500">/</span>
    <p>Rechercher</p>
</section>

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">Rechercher</h1>
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

    <section class="w-full md:p-0 {{ $products->count() > 1 ? 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-16' : 'flex items-center justify-center' }}">
        @forelse ($products as $product)
            @include('shop.products.card', ['product' => $product, 'category' => $product->categories->first()])
        @empty
            <p class="text-2xl inline mx-auto font-semibold text-center px-8 py-12 rounded bg-primary-700"><strong>Oups!</strong> Aucun vêtement correspondant à votre recherche n'a été trouvé 😶</p>
        @endforelse
    </section>
</section>

@endsection