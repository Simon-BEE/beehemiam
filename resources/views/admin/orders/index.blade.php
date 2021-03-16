@extends('layouts.back')

@section('meta-title')
    Voir toutes les commandes
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de
                bord</a>
            <span class="text-gray-500">/</span>
            <p>Voir toutes les commandes</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir toutes les commandes
            </h2>
        </div>

        <div class="hidden">
            <span class="bg-teal-500"></span>
            <span class="bg-orange-500"></span>
            <span class="bg-pink-500"></span>
            <span class="bg-purple-500"></span>
            <span class="bg-red-500"></span>
            <span class="bg-yellow-500"></span>
            <span class="bg-blue-500"></span>
            <span class="bg-green-500"></span>
            <span class="bg-gray-500"></span>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-5">N° de commande</th>
                            <th class="px-4 py-5">Montant total</th>
                            <th class="px-4 py-5">Nombre d'articles</th>
                            <th class="px-4 py-5">Statut</th>
                            <th class="px-4 py-5">Passée le</th>
                            <th class="px-4 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <p class="font-semibold">#{{ $order->id }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                        {{ $order->formatted_price }}€
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm ml-16">
                                    <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                        {{ $order->order_items_count }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <span class="rounded-full text-white bg-{{ $order->status->color }}-500 p-2">
                                        {{ $order->status->name }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                   {{ $order->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="#"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-purple-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Show">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">
                                    Aucune commande n'a été passée pour le moment.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $orders->links() }}
            </div>
        </div>

    </div>
@endsection
