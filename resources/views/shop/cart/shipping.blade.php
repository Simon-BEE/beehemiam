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

@push('modal')
    <div class="w-full text-kaki-800 flex flex-col justify-center items-center space-y-4">
        <h3 class="text-2xl font-bold">Vêtement ajouté au panier</h3>
        <svg class="w-32 h-32 my-8" viewBox="0 0 24 24">
            <path fill="currentColor" d="M20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.76,4 13.5,4.11 14.2,4.31L15.77,2.74C14.61,2.26 13.34,2 12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z" />
        </svg>
        <p>Le vêtement a bien été ajouté au panier ! Vous pouvez continuer de visiter la boutique, ou bien passer directement à la finalisation de la commande.</p>
    </div>
    <div class="mt-12 flex justify-center items-center">
        <close-modal-button classes="bg-primary-200 rounded px-3 py-2 hover:bg-primary-300 inline-flex items-center mr-4">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 20C19 21.11 18.11 22 17 22C15.89 22 15 21.1 15 20C15 18.89 15.89 18 17 18C18.11 18 19 18.9 19 20M7 18C5.89 18 5 18.89 5 20C5 21.1 5.89 22 7 22C8.11 22 9 21.11 9 20S8.11 18 7 18M7.2 14.63L7.17 14.75C7.17 14.89 7.28 15 7.42 15H19V17H7C5.89 17 5 16.1 5 15C5 14.65 5.09 14.32 5.24 14.04L6.6 11.59L3 4H1V2H4.27L5.21 4H20C20.55 4 21 4.45 21 5C21 5.17 20.95 5.34 20.88 5.5L17.3 11.97C16.96 12.58 16.3 13 15.55 13H8.1L7.2 14.63M8.5 11H10V9H7.56L8.5 11M11 9V11H14V9H11M14 8V6H11V8H14M17.11 9H15V11H16L17.11 9M18.78 6H15V8H17.67L18.78 6M6.14 6L7.08 8H10V6H6.14Z" />
            </svg>
            Je continue mes achats
        </close-modal-button>
        <button class="inline-flex items-center rounded p-2 transition-colors text-white bg-primary-500 duration-200 hover:bg-primary-600 font-semibold">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M13 19C13 18.66 13.04 18.33 13.09 18H3V12H19V13C19.7 13 20.37 13.13 21 13.35V6C21 4.89 20.11 4 19 4H3C1.89 4 1 4.89 1 6V18C1 19.1 1.89 20 3 20H13.09C13.04 19.67 13 19.34 13 19M3 6H19V8H3V6M17.75 22L15 19L16.16 17.84L17.75 19.43L21.34 15.84L22.5 17.25L17.75 22" />
            </svg>
            Je finalise ma commande
        </button>
    </div>
@endpush