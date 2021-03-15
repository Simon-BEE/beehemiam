@extends('layouts.app')

@section('meta-title')
    Commande n°{{ $order->id }}
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <a href="{{ route('user.orders.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon historique de commande</a>
        <span class="text-gray-500">/</span>
        <p>Commande n°{{ $order->id }}</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex flex-col md:flex-row items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Commande n°{{ $order->id }}</h2>
                <p class="text-sm">Ma commande passée le {{ $order->created_at->format('d/m/Y') }}</p>
            </div>
            <x-form.button>
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13,9V3.5L18.5,9M6,2C4.89,2 4,2.89 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2H6Z" />
                </svg>
                Télécharger la facture
            </x-form.button>
        </div>

        <section class="my-6">
            <x-info>
                <p>{{ $order->verbose_status }} </p>
                @if ($order->has_preorder && $order->is_in_progress)
                    <p>&nbsp; Elle sera expédiée lorsque la précommande sera terminée.</p>
                @endif
            </x-info>
        </section>

        <section class="my-6">
            <p>Vous avez passé commande le <strong>{{ $order->created_at->format('d/m/Y à H:i') }}</strong> pour un montant total TTC de <strong>{{ $order->formatted_price }}€</strong> contenant <strong>{{ $order->orderItems->count() < 2 ? '1 article' : $order->orderItems->count() . ' articles' }}</strong>.</p>
        </section>

        <section class="w-full flex flex-col md:flex-row items-start justify-between md:space-x-5">
            <article class="w-full md:w-1/3">
                <img src="https://source.unsplash.com/300x300/daily?clothing" alt="commande n°{{ $order->id }}" class="w-full object-cover">
            </article>

            <table class="w-full md:w-2/3 text-center">
                <thead>
                    <tr class="bg-primary-200">
                        <th class="px-2 py-3 font-bold">Nom du vêtement</th>
                        <th class="px-2 py-3 font-bold">Quantité</th>
                        <th class="px-2 py-3 font-bold">Prix Unitaire</th>
                        <th class="px-2 py-3 font-bold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr class="{{ $loop->even ? 'bg-primary-200' : '' }} hover:bg-primary-300">
                            <td class="px-2 py-3">
                                @if ($item->productOption)
                                    <a href="{{ $item->productOption->path }}" class="hover:underline">{{ $item->name }}</a>
                                @else
                                    {{ $item->name }}
                                @endif
                            </td>
                            <td class="px-2 py-3">{{ $item->quantity }}</td>
                            <td class="px-2 py-3">{{ $item->formatted_price }}€</td>
                            <td class="px-2 py-3">{{ $item->formatted_price * $item->quantity }}€</td>
                        </tr>
                    @endforeach
                    <tr class="">
                        <td colspan="2" class="p-2"></td>
                        <td class="p-2 border-b border-primary-300 font-bold">Frais de port TTC</td>
                        <td class="p-2 border-b border-primary-300 font-bold">{{ $order->formatted_shipping_fees }}€</td>
                    </tr>
                    <tr class="">
                        <td colspan="2" class="p-2"></td>
                        <td class="p-2 border-b border-primary-300 font-bold">Montant total HT</td>
                        <td class="p-2 border-b border-primary-300 font-bold">{{ $order->formatted_price_without_taxes }}€</td>
                    </tr>
                    <tr class="">
                        <td colspan="2" class="p-2"></td>
                        <td class="p-2 border-b border-primary-300 font-bold">Montant total TTC</td>
                        <td class="p-2 border-b border-primary-300 font-bold">{{ $order->formatted_price }}€</td>
                    </tr>
                </tbody>
            </table>
        </section>

        @if ($order->created_at->addMinutes(15) > now())
            <section class="mt-8 p-4 rounded bg-primary-300">

                <p>Vous pouvez annuler votre commande dans les 15 minutes suivant la confirmation. pour cela veuillez cliquer sur le bouton ci-dessous.</p>
                <p>Votre commande et votre paiement seront annulé immédiatement.</p>

                <div class="mt-4 text-center">
                    <x-form.button class="bg-red-400 text-white  hover:bg-red-500 font-semibold">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M14.5 11C14.78 11 15 11.22 15 11.5V13H9V11.5C9 11.22 9.22 11 9.5 11H14.5M18.5 12C19 12 19.5 12.07 20 12.18V10H18V12.03C18.17 12 18.33 12 18.5 12M6 19V10H4V21H12.5C12.24 20.38 12.09 19.7 12.03 19H6M21 9H3V3H21V9M19 5H5V7H19V5M23 18.5C23 21 21 23 18.5 23S14 21 14 18.5 16 14 18.5 14 23 16 23 18.5M20 21.08L15.92 17C15.65 17.42 15.5 17.94 15.5 18.5C15.5 20.16 16.84 21.5 18.5 21.5C19.06 21.5 19.58 21.35 20 21.08M21.5 18.5C21.5 16.84 20.16 15.5 18.5 15.5C17.94 15.5 17.42 15.65 17 15.92L21.08 20C21.35 19.58 21.5 19.06 21.5 18.5Z" />
                        </svg>
                        Annuler ma commande
                    </x-form.button>
                </div>
            </section>
        @endif
</x-layouts.user>

@endsection

