@extends('layouts.app')

@section('meta-title'){{ $product->name }} / {{ $product->optionName }} &mdash; {{ $category->name }} @endsection

@section('meta-desc'){{ $product->optionDescription }}@endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center md:justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('shop.categories.index') }}" class="hover:text-primary-600">Toutes les collections</a>
    <span class="text-primary-500">/</span>
    <a href="{{ route('shop.categories.show', $category) }}" class="hover:text-primary-600">{{ $category->name }}</a>
    <span class="text-primary-500">/</span>
    <p>{{ $product->name }} - {{ $product->optionName }}</p>
</section>


{{-- <input class="rounded-lg overflow-hidden appearance-none bg-gray-400 h-3 w-128 focus:outline-none" type="range" min="1" max="100" step="1" value="15" /> --}}



<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-12">
        {{-- <h1 class="text-5xl md:text-7xl font-cursive">{{ $product->optionName }}</h1> --}}
    </article>

    <section class="w-full flex flex-col md:flex-row items-start justify-between">
        {{-- Images --}}
        <section class="images w-full p-4 bg-primary-100 rounded shadow-lg md:w-1/3 overflow-x-hidden md:mt-4">
            <images-gallery 
                :product-name="{{ json_encode($product->optionName . ' ' . $currentOption->name) }}" 
                :product-images="{{ json_encode($images) }}"
                :product-thumbs="{{ json_encode($thumbs) }}"
            >
            </images-gallery>
        </section>

    
        <section class="card w-full mt-8 md:mt-0 md:w-2/3 md:pl-16 flex flex-col space-y-6">

            @includeWhen(!$product->is_preorder, 'shop.products.includes.product-order')

            @includeWhen($product->is_preorder, 'shop.products.includes.product-preorder')

            <article class="flex flex-col space-y-4 md:w-1/3">
                <a href="#" class="inline-flex items-center px-2 py-1 rounded text-primary-500 transition-colors duration-300 hover:text-primary-600 hover:bg-primary-300">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 4A3.5 3.5 0 0 0 8.5 7.5H10.5A1.5 1.5 0 0 1 12 6A1.5 1.5 0 0 1 13.5 7.5A1.5 1.5 0 0 1 12 9C11.45 9 11 9.45 11 10V11.75L2.4 18.2A1 1 0 0 0 3 20H21A1 1 0 0 0 21.6 18.2L13 11.75V10.85A3.5 3.5 0 0 0 15.5 7.5A3.5 3.5 0 0 0 12 4M12 13.5L18 18H6Z" />
                    </svg>
                    Voir le guide des tailles
                </a>
                <a href="#" class="inline-flex items-center px-2 py-1 rounded text-primary-500 transition-colors duration-300 hover:text-primary-600 hover:bg-primary-300">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                    </svg>
                    Informations sur la livraison
                </a>
            </article>
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
        <a href="{{ route('cart.index') }}" class="inline-flex items-center rounded p-2 transition-colors text-white bg-primary-500 duration-200 hover:bg-primary-600 font-semibold">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M13 19C13 18.66 13.04 18.33 13.09 18H3V12H19V13C19.7 13 20.37 13.13 21 13.35V6C21 4.89 20.11 4 19 4H3C1.89 4 1 4.89 1 6V18C1 19.1 1.89 20 3 20H13.09C13.04 19.67 13 19.34 13 19M3 6H19V8H3V6M17.75 22L15 19L16.16 17.84L17.75 19.43L21.34 15.84L22.5 17.25L17.75 22" />
            </svg>
            Je finalise ma commande
        </a>
    </div>
@endpush