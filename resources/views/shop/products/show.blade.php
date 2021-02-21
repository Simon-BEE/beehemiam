@extends('layouts.app')

@section('meta-title'){{ $product->name }} &mdash; {{ $category->name }} @endsection

@section('meta-desc'){{ $product->optionDescription }}@endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center justify-end flex-wrap space-x-2 text-kaki-800">
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
                    <img src="{{ $currentOption->main_image->path }}" alt="{{ $currentOption->name }} image" class="rounded">
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
                <x-form.form action="" method="">
                    <article>
                        <p class="font-semibold">Séléctionner ma taille</p>
        
                        <sizes-selector :selected-size="{{ json_encode($selectedSize) }}" :sizes="{{ json_encode($currentOption->sizes) }}" />
            
                        {{-- <div class="mt-4">
                            @foreach ($currentOption->sizes as $size)
                                <button 
                                    class="p-4 rounded font-bold transition-colors duration-300 {{ $selectedSize->id == $size->id ? 'bg-primary-500 hover:bg-primary-400' : 'bg-primary-300 hover:bg-primary-400' }} focus:outline-none"
                                    wire:click="selectSize({{ $size->id }})"
                                >
                                    {{ $size->size->name }}
                                </button>
                            @endforeach
                        </div> --}}
                    </article>
            
                    <article class="flex flex-col md:flex-row items-center mt-8 space-x-4">
                        <span class="p-6 font-bold text-5xl bg-primary-300">{{ $currentOption->formatted_price }}€</span>
            
                        <button class="p-8 inline-flex items-center font-semibold text-2xl transition-colors duration-300 hover:bg-primary-300">
                            <svg class="w-7 h-7 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20 15V18H23V20H20V23H18V20H15V18H18V15H20M12 13C10.9 13 10 13.9 10 15S10.9 17 12 17 14 16.1 14 15 13.1 13 12 13M13.35 21H5.5C4.58 21 3.81 20.38 3.58 19.54L1.04 10.27C1 10.18 1 10.09 1 10C1 9.45 1.45 9 2 9H6.79L11.17 2.45C11.36 2.16 11.68 2 12 2S12.64 2.16 12.83 2.44L17.21 9H22C22.55 9 23 9.45 23 10L22.97 10.27L22 13.81C21.43 13.5 20.79 13.24 20.12 13.11L20.7 11H3.31L5.5 19H13C13 19.7 13.13 20.37 13.35 21M9.2 9H14.8L12 4.8L9.2 9Z" />
                            </svg>
                            Ajouter au panier
                        </button>
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