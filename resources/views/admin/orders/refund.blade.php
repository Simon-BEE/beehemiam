@extends('layouts.back')

@section('meta-title')
    Effectuer un remboursement pour la commande n°{{ $order->id }}
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir toutes les commandes</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-gray-700 dark:hover:text-gray-100">Commande n°{{ $order->id }}</a>
            <span class="text-gray-500">/</span>
            <p class="">Effectuer un remboursement pour la commande n°{{ $order->id }}</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <div class="flex items-center">
                <div class="">
                    <h2 class="font-bold text-2xl text-gray-700 dark:text-gray-300">Commande n°{{ $order->id }} <span class="font-normal">({{ $order->formatted_price }}€)</span></h2>
                    <p class="text-sm text-gray-500">Dernier changement de statut {{ $order->updated_at->diffForHumans() }}</p>
                </div>
            </div>
            @if ($order->user)
                <x-back.link-button href="{{ route('admin.users.show', $order->user) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                    </svg>
                    Voir les informations client
                </x-back.link-button>
            @endif
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-8 lg:space-y-0 lg:space-x-8 lg:mb-8">
            <section class="px-4 py-8 w-full bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">Commande n°{{ $order->id }}</h2>
                        <p class="text-gray-500 text-sm my-2">
                            Statut actuel
                            <span class="rounded-full text-white bg-{{ $order->status->color }}-500 py-1 px-2 ml-3">
                                {{ $order->status->name }}
                            </span>
                        </p>
                    </article>

                    <article class="w-full my-4">
                        <p>Le remboursement sera effectué au client ayant commandé avec l'adresse email <strong>{{ $order->email_contact }}</strong>.</p>

                        <p class="w-full md:w-1/2 mt-2">
                            <x-back.link-button href="{{ route('admin.transactions.payments.show', $order->payment) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                                <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                                </svg>
                                Avoir plus d'informations sur le paiement de la commande
                            </x-back.link-button>
                        </p>
                    </article>

                    <article class="w-full mt-4 mb-3">
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li class="p-4 rounded bg-gray-100 dark:bg-gray-900 text-gray-500 mb-2 flex items-center justify-between border-l-4 border-purple-500">
                                    <p><a href="{{ $item->productOption->path }}" class="hover:underline">{{ $item->name }}</a> (Taille {{ $item->size->name }})</p>
                                    <p>{{ $item->formatted_price }}€ (x {{ $item->quantity }})</p>
                                </li>
                            @endforeach
                            @if ($order->coupons)
                                @foreach ($order->coupons as $coupon)
                                    <li class="p-4 rounded bg-gray-100 dark:bg-gray-900 text-gray-500 mb-2 flex items-center justify-between border-l-4 border-yellow-500">
                                        <p>{{ $coupon->code }}</p>
                                        <p>{{ $coupon->amount }}€</p>
                                    </li>
                                @endforeach
                            @endif
                            <li class="p-4 rounded bg-gray-100 dark:bg-gray-900 text-gray-500 mb-2 flex items-center justify-between border-l-4 border-blue-500">
                                <p>Frais de port</p>
                                <p>{{ $order->formatted_shipping_fees }}€</p>
                            </li>
                        </ul>
                    </article>

                    <form action="{{ route('admin.orders.refund.update', $order) }}" method="POST" class="w-full md:w-1/2">
                        @csrf
                        @method('PATCH')
                        <x-back.form.input-icon
                            name="amount"
                            type="text"
                            label="Montant à rembourser"
                            placeholder="Montant à rembourser"
                            helper="Le montant doit être inferieur au total de la commande ({{ $order->formatted_total_with_refund }}€)"
                            value="{{ $order->formatted_total_with_refund }}"
                            required
                        >
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.07,11L7,12L7.07,13H17.35L16.5,15H7.67C8.8,17.36 11.21,19 14,19C16.23,19 18.22,17.96 19.5,16.33V19.12C18,20.3 16.07,21 14,21C10.08,21 6.75,18.5 5.5,15H2L3,13H5.05L5,12L5.05,11H2L3,9H5.5C6.75,5.5 10.08,3 14,3C16.5,3 18.8,4.04 20.43,5.71L19.57,7.75C18.29,6.08 16.27,5 14,5C11.21,5 8.8,6.64 7.67,9H19.04L18.19,11H7.07Z" />
                        </svg>
                        </x-back.form.input-icon>


                        <x-back.form.button>
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                            </svg>
                            Rembourser
                        </x-back.form.button>

                    </form>
                </div>
            </section>
        </div>

@endsection
