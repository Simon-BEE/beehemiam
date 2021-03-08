@extends('layouts.app')

@section('meta-title')Mon panier @endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center md:justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    {{-- <a href="{{ route('shop.categories.index') }}" class="hover:text-primary-600">Toutes les collections</a>
    <span class="text-primary-500">/</span>
    <a href="{{ route('shop.categories.show', $category) }}" class="hover:text-primary-600">{{ $category->name }}</a>
    <span class="text-primary-500">/</span> --}}
    <p>Mon panier</p>
</section>

<section class="flex flex-col items-center justify-center p-4 md:p-0 overflow-x-hidden">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">Mon panier</h1>
    </article>

    @if (count($cart) > 0)
        <section class="w-full flex flex-col md:flex-row items-start justify-between md:space-x-4 mt-12">

            <section class="w-full md:w-2/3 overflow-x-auto">
                <cart-table :product-options="{{ json_encode($cart) }}"></cart-table>
            </section>

            <section class="w-full md:w-1/3 mt-8 md:mt-0 ">
                <cart-resume :cart-sub-total="{{ $subTotal }}" :coupon="{{ json_encode($coupon) }}"></cart-resume>
        
                <section class="w-full flex justify-center mt-12">
                    <a href="{{ route('cart.shippings.index') }}" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center bg-primary-500 text-white  hover:bg-primary-400 font-bold text-lg">
                        <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9 20C9 21.11 8.11 22 7 22S5 21.11 5 20 5.9 18 7 18 9 18.9 9 20M17 18C15.9 18 15 18.9 15 20S15.9 22 17 22 19 21.11 19 20 18.11 18 17 18M7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L21.16 4.96L19.42 4H19.41L18.31 6L15.55 11H8.53L8.4 10.73L6.16 6L5.21 4L4.27 2H1V4H3L6.6 11.59L5.25 14.04C5.09 14.32 5 14.65 5 15C5 16.11 5.9 17 7 17H19V15H7.42C7.29 15 7.17 14.89 7.17 14.75M18 2.76L16.59 1.34L11.75 6.18L9.16 3.59L7.75 5L11.75 9L18 2.76Z" />
                        </svg>
                        Valider mon panier et passer à l'étape suivante
                    </a>
                </section>
            </section>
        </section>
    @else
        <section class="my-16 text-center">
            <p>Votre panier est vide ! <a href="{{ route('shop.categories.index') }}" class="text-primary-500 hover:underline">Retourner à la boutique</a></p>
        </section>
    @endif

</section>

@endsection