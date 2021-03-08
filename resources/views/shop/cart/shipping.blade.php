@extends('layouts.app')

@section('meta-title')Adresse et livraison @endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center md:justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('cart.index') }}" class="hover:text-primary-600">Mon panier</a>
    <span class="text-primary-500">/</span>
    <p>Adresse et livraison</p>
</section>

<section class="flex flex-col items-center justify-center p-4 lg:p-0 overflow-x-hidden">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">Adresse et livraison</h1>
        <p class="mt-8">Enregistrez vos coordonnées pour finaliser votre commande, les frais de port seront ajustés selon votre géolocalisation. Vous pouvez créer un compte, vous connecter, ou alors passer une commande sans être enregistré. C'est comme vous préférez.</p>
    </article>

    <section class="w-full flex flex-col lg:flex-row items-start justify-between lg:space-x-4 mt-12">
        
        <section class="w-full lg:w-2/3">
            @includeWhen(!auth()->check(), 'shop.cart.shipping.guest')

            @includeWhen(auth()->check(), 'shop.cart.shipping.auth')
        </section>

        <section class="w-full lg:w-1/3 mt-8 lg:mt-0 ">
            <cart-info 
                :cart-items="{{ json_encode($cart) }}" 
                :coupon="{{ json_encode($coupon) }}" 
                :cart-sub-total="{{ $subTotal }}"
                :country-id="{{ json_encode(auth()->user()?->address?->country->id ?? 1) }}"
            ></cart-info>

            <section class="w-full flex justify-center mt-12">
                <button form="addressForm" type="submit" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center bg-primary-500 text-white  hover:bg-primary-400 font-bold text-lg">
                    <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3M5 10.5L6.5 9L8 10.5L11.5 7L13 8.5L8 13.5L5 10.5Z" />
                    </svg>
                    Valider mes informations de livraisons et aller à la caisse
                </button>
            </section>
        </section>

    </section>

</section>

@endsection