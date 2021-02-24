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

    <section class="w-full flex flex-col md:flex-row items-start justify-between md:space-x-4">

        <section class="w-full md:w-2/3 overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="border-b-2 border-primary-300">
                        <th class="hidden md:table-cell p-4"></th>
                        <th class="p-4"></th>
                        <th class="p-4">Prix</th>
                        <th class="p-4">Quantité</th>
                        <th class="p-4">Sous-total</th>
                    </tr>
                </thead>
    
                <tbody>
                    <tr>
                        <td class="hidden md:table-cell px-2 py-6 md:w-1/6">
                            <img src="https://source.unsplash.com/150x150/daily?boho" alt="Product image" class="w-24 h-24 rounded">
                        </td>
                        <td class="px-2 py-6 md:w-1/2">
                            <h3 class="font-bold text-xl mb-1">Nom du produit</h3>
                            <p class="text-sm uppercase font-semibold">Taille S</p>
                        </td>
                        <td class="px-2 py-6 text-center">
                            15€
                        </td>
                        <td class="px-2 py-6 text-center">
                            <input 
                                class="border border-primary-200 rounded focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500"
                                type="number" name="quantity" id="quantity" value="1" step="1" min="1" max="10"
                            >
                        </td>
                        <td class="px-2 py-6 text-center">
                            15€
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="w-full md:w-1/3 mt-8 md:mt-0 bg-primary-200 p-4 rounded">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem cumque eum earum totam illum quidem voluptas consectetur facere quam fuga quibusdam, debitis rerum excepturi temporibus modi autem vero quasi assumenda!
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