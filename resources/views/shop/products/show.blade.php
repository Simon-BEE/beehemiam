@extends('layouts.app')

@section('meta-title'){{ $product->name }} &mdash; {{ $category->name }} @endsection

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
    <p>{{ $product->name }}</p>
</section>

<section class="flex flex-col items-center justify-center p-4 md:p-0">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">{{ $product->name }}</h1>
    </article>

    <section class="w-full flex flex-col md:flex-row items-start justify-between">
        {{-- Images --}}
        <section class="images w-full p-4 bg-primary-100 rounded shadow-lg md:w-1/3 overflow-x-hidden">
            <article class="w-full">
                <figure class="relative cursor-pointer group">
                    <img src="{{ $currentOption->main_image?->path }}" alt="{{ $currentOption->name }} image" class="rounded">
                    <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                        <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                        </svg>
                    </figcaption>
                </figure>
            </article>
            <article class="flex w-full justify-between mt-4">
                <figure class="relative cursor-pointer group">
                    <img src="https://source.unsplash.com/150x150/daily?bohemian" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                    <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                        <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                        </svg>
                    </figcaption>
                </figure>
                <figure class="relative cursor-pointer group">
                    <img src="https://source.unsplash.com/150x150/daily?boho" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                    <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                        <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                        </svg>
                    </figcaption>
                </figure>
                <figure class="relative cursor-pointer group">
                    <img src="https://source.unsplash.com/150x150/daily?peace" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                    <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                        <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                        </svg>
                    </figcaption>
                </figure>
            </article>
        </section>
    
        <section class="card w-full mt-8 md:mt-0 md:w-2/3 md:pl-16 flex flex-col space-y-6">
            <div class="title">
                <h2 class="font-bold text-7xl">{{ $currentOption->name }}</h2>
                <p class="">
                    @if ($currentOption->is_available)
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3M5 10.5L6.5 9L8 10.5L11.5 7L13 8.5L8 13.5L5 10.5Z" />
                        </svg>
                        <span class="text-xs uppercase">Le vêtement est actuellement en stock</span>
                    </span>
                    @endif
            </div>
    
            <article class="w-full md:w-2/3">
                <p>{!! $currentOption->description !!}</p>
            </article>
    
            @if ($currentOption->is_available)
                <x-form.form action="#" method="#" id="addCartForm">
                    <article>
                        <p class="font-semibold">Séléctionner ma taille</p>

                        <sizes-selector :selected-size="{{ json_encode($selectedSize) }}" :sizes="{{ json_encode($currentOption->sizes) }}" />
                    </article>
            
                    <article class="flex flex-col md:flex-row items-center mt-8 space-x-4">
                        <span class="p-6 font-bold text-5xl bg-primary-300">{{ $currentOption->formatted_price }}€</span>

                        <add-cart :product-option="{{ json_encode($currentOption) }}"></add-cart>
                    </article>
                </x-form.form>
            @else
                <article class="bg-primary-300 p-8 rounded w-full md:w-2/3">
                    <p class="font-bold">Le vêtement est actuellement indisponible.</p>
                    <a href="#" class="mt-4 p-5 rounded-lg bg-primary-100 inline-flex items-center text-primary-500 hover:bg-primary-200">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10.07,14.27C10.57,14.03 11.16,14.25 11.4,14.75L13.7,19.74L15.5,18.89L13.19,13.91C12.95,13.41 13.17,12.81 13.67,12.58L13.95,12.5L16.25,12.05L8,5.12V15.9L9.82,14.43L10.07,14.27M13.64,21.97C13.14,22.21 12.54,22 12.31,21.5L10.13,16.76L7.62,18.78C7.45,18.92 7.24,19 7,19A1,1 0 0,1 6,18V3A1,1 0 0,1 7,2C7.24,2 7.47,2.09 7.64,2.23L7.65,2.22L19.14,11.86C19.57,12.22 19.62,12.85 19.27,13.27C19.12,13.45 18.91,13.57 18.7,13.61L15.54,14.23L17.74,18.96C18,19.46 17.76,20.05 17.26,20.28L13.64,21.97Z" />
                        </svg>
                        Je veux être averti lorsque le vêtement sera de nouveau en stock
                    </a>
                </article>
            @endif
    
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
        <button class="inline-flex items-center rounded p-2 transition-colors text-white bg-primary-500 duration-200 hover:bg-primary-600 font-semibold">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M13 19C13 18.66 13.04 18.33 13.09 18H3V12H19V13C19.7 13 20.37 13.13 21 13.35V6C21 4.89 20.11 4 19 4H3C1.89 4 1 4.89 1 6V18C1 19.1 1.89 20 3 20H13.09C13.04 19.67 13 19.34 13 19M3 6H19V8H3V6M17.75 22L15 19L16.16 17.84L17.75 19.43L21.34 15.84L22.5 17.25L17.75 22" />
            </svg>
            Je finalise ma commande
        </button>
    </div>
@endpush