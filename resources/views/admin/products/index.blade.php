@extends('layouts.back')

@section('meta-title')
    Voir tous les vêtements
@endsection

@section('content')
    <div class="container grid px-6 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de
                bord</a>
            <span class="text-gray-500">/</span>
            <p>Voir tous les vêtements</p>
        </section>

        <div class="title my-6 flex flex-col md:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir tous les vêtements
            </h2>
            <x-back.link-button href="{{ route('admin.products.create') }}">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 12H14V10H16V12H18V14H16V16H14V14H12V12M22 8V18C22 19.11 21.11 20 20 20H4C2.89 20 2 19.11 2 18V6C2 4.89 2.89 4 4 4H10L12 6H20C21.11 6 22 6.89 22 8M20 8H4V18H20V8Z" />
                </svg>
                Ajouter un nouveau vêtement
            </x-back.link-button>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Nom</th>
                            <th class="px-4 py-3">Précommande</th>
                            <th class="px-4 py-3">Statut</th>
                            <th class="px-4 py-3">Créé le</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($products as $product)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <p class="font-semibold">{{ $product->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    @if ($product->is_preorder)
                                        <span class="rounded-full bg-purple-500 text-white p-2 whitespace-nowrap">
                                            En précommande
                                        </span>
                                    @else
                                        <span class="rounded-full bg-blue-500 text-white p-2 whitespace-nowrap">
                                            En vente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    @if ($product->is_active)
                                        <span class="rounded-full bg-green-500 text-white p-2 whitespace-nowrap">
                                            En ligne
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-500 text-white p-2 whitespace-nowrap">
                                           Hors-ligne
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                   {{ $product->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    Aucun vêtement n'a été enregisté. <a href="{{ route('admin.products.create') }}"
                                        class="text-indigo-500 hover:underline">Créez en un !</a>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $products->links() }}
            </div>
        </div>

    </div>
@endsection
