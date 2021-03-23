@extends('layouts.back')

@section('meta-title')
    {{ $transaction instanceof \App\Models\Payment ? 'Paiement' : 'Remboursement' }} n°{{ $transaction->id }}
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
            <a href="{{ route('admin.transactions.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir toutes les transactions</a>
            <span class="text-gray-500">/</span>
            <p>{{ $transaction instanceof \App\Models\Payment ? 'Paiement' : 'Remboursement' }} n°{{ $transaction->id }}</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $transaction instanceof \App\Models\Payment ? 'Paiement' : 'Remboursement' }} n°{{ $transaction->id }}
            </h2>
        </div>

        <section class="flex flex-col md:flex-row items-start justify-between md:space-x-6">
            <section class="px-4 py-3 w-full md:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col lg:flex-row justify-between items-start">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">{{ $transaction instanceof \App\Models\Payment ? 'Paiement' : 'Remboursement' }} n°{{ $transaction->id }}</h2>
                        <p class="text-gray-500 text-sm">Effectué le {{ $transaction->created_at->format('d/m/Y à H:i') }}</p>
                    </article>
                </div>

                <article class="my-4 text-gray-500">
                    <p>Montant total : <strong>{{ $transaction->formatted_amount }}€</strong></p>
                </article>

                <article class="my-4 text-gray-500">
                    <p>Référence de la transaction : <strong>{{ $transaction->reference }}</strong></p>
                </article>

                <article class="my-4 text-gray-500">
                    <p class="w-1/2 mx-auto">
                        <x-back.link-button href="{{ $transaction->stripe_page }}" target="_blank" class="bg-teal-500 text-gray-100 hover:bg-teal-600">
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20 4H4A2 2 0 0 0 2 6V18A2 2 0 0 0 4 20H20A2 2 0 0 0 22 18V6A2 2 0 0 0 20 4M20 11H4V8H20M7 22H9V24H7V22M11 22H13V24H11V22M15 22H17V24H15Z" />
                            </svg>
                            <span class="text-lg font-bold">Voir en détail sur stripe</span>
                        </x-back.link-button>
                    </p>
                </article>
            </section>

            <section class="px-4 py-3 w-full md:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col lg:flex-row justify-between items-start">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">Lié à la commande n°{{ $transaction->order->id }}</h2>
                        <p class="text-gray-500 text-sm">Du {{ $transaction->order->created_at->format('d/m/Y à H:i') }}</p>
                    </article>
                </div>

                <article class="my-4 text-gray-500">
                    <p>Montant de la commande : <strong>{{ $transaction->order->formatted_price }}€</strong></p>
                </article>

                <article class="my-4 text-gray-500">
                    <p class="w-1/2 mx-auto">
                        <x-back.link-button href="{{ route('admin.orders.show', $transaction->order) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                            </svg>
                            <span class="text-lg font-bold">Voir la en détail la commande</span>
                        </x-back.link-button>
                    </p>
                </article>
            </section>
        </section>

    </div>
@endsection
