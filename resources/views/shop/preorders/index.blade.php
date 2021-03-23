@extends('layouts.app')

@section('meta-title')
    Les précommandes
@endsection

@section('meta-desc')
    Découvrez l'ensemble des vêtements proposés en précommande par Beehemiam. Ces articles ont une disponibilité et des stocks limités.
@endsection

@section('content')

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-8 md:mb-16">
        <h1 class="text-5xl md:text-7xl font-cursive">Les Précommandes</h1>
        <p class="mt-8">Découvrez l'ensemble des vêtements proposés en précommande par Beehemiam. Ces articles ont une disponibilité et des stocks limités.</p>
    </article>

    <section class="w-full md:p-0 {{ $products->count() > 1 ? 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 lg:gap-16' : 'flex items-center justify-center' }}">
        @forelse ($products as $product)
            @include('shop.products.card', ['product' => $product, 'category' => $product->categories->first()])
        @empty
            <p class="text-2xl inline mx-auto font-semibold text-center px-8 py-12 rounded bg-primary-700"><strong>Oups!</strong> Aucun produit disponible en précommande pour le moment 😶</p>
        @endforelse
    </section>
</section>

@endsection
