@extends('layouts.app')

@section('meta-title')
    Mon historique de commande
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <p>Mon historique de commande</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex flex-col md:flex-row items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Mon historique de commande</h2>
                <p class="text-sm">Mes commandes passées sur Beehemiam.fr</p>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 py-8">
            @forelse ($orders as $order)
                <div class="relative border border-primary-200 p-4 rounded-sm w-full flex flex-col space-y-2">
                    <article class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Commande n°{{ $order->id }}</h3>
                        <span class="text-gray-400 text-xs">{{ $order->created_at->diffForHumans() }}</span>
                    </article>

                    <article class="">
                        <p class="flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                            </svg>
                            {{ $order->status->name }}
                        </p>
                    </article>

                    <article class="rounded bg-primary-200 px-2 py-4">
                        <p class="">
                            Montant payé <strong>{{ $order->formatted_price }}€</strong>
                        </p>
                    </article>
                    <p class="mt-4 text-right text-sm">
                        <a href="{{ $order->path }}" class="text-primary-500 hover:underline">&rarr; Détails de la commande...</a>
                    </p>
                </div>
            @empty
                <p class="w-full my-4 text-center">
                    Vous n'avez jamais passé de commande sur le site pour le moment.
                </p>
            @endforelse
        </section>

        <section class="">
            {{ $orders->links('includes.pagination.simple-front-tailwind') }}
        </section>
</x-layouts.user>

@endsection

