@extends('layouts.back')

@section('meta-title')
    Commande n°{{ $order->id }}
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
            <p>Commande n°{{ $order->id }}</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <div class="flex items-center">
                <div class="">
                    <h2 class="font-bold text-2xl text-gray-700 dark:text-gray-300">Commande n°{{ $order->id }} <span class="font-normal">({{ $order->formatted_price }}€)</span></h2>
                    <p class="text-sm text-gray-500">Passée {{ $order->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="actions flex flex-col lg:flex-row items-center space-y-1 lg:space-y-0 lg:space-x-1">
                @if ($order->user)
                    <x-back.link-button href="{{ route('admin.users.show', $order->user) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                        <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
                        </svg>
                        Voir le client
                    </x-back.link-button>
                @endif
                @if (!$order->is_cancelled && !$order->is_completed)
                    <x-back.link-button href="{{ route('admin.orders.status.show', $order) }}" class="bg-purple-500 text-white hover:bg-purple-600">
                        <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21,10.12H14.22L16.96,7.3C14.23,4.6 9.81,4.5 7.08,7.2C4.35,9.91 4.35,14.28 7.08,17C9.81,19.7 14.23,19.7 16.96,17C18.32,15.65 19,14.08 19,12.1H21C21,14.08 20.12,16.65 18.36,18.39C14.85,21.87 9.15,21.87 5.64,18.39C2.14,14.92 2.11,9.28 5.62,5.81C9.13,2.34 14.76,2.34 18.27,5.81L21,3V10.12M12.5,8V12.25L16,14.33L15.28,15.54L11,13V8H12.5Z" />
                        </svg>
                        Modifier le statut de commande
                    </x-back.link-button>
                @endif
                @if ($order->is_in_progress && !$order->is_shipped)
                    <x-back.form.button
                        class="bg-red-500 text-white hover:bg-red-600"
                        @click="changeModalButtonLink(`{{ route('admin.orders.cancel', $order) }}`);openModal();"
                        aria-label="Delete"
                    >
                        <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M14.5 11C14.78 11 15 11.22 15 11.5V13H9V11.5C9 11.22 9.22 11 9.5 11H14.5M18.5 12C19 12 19.5 12.07 20 12.18V10H18V12.03C18.17 12 18.33 12 18.5 12M6 19V10H4V21H12.5C12.24 20.38 12.09 19.7 12.03 19H6M21 9H3V3H21V9M19 5H5V7H19V5M23 18.5C23 21 21 23 18.5 23S14 21 14 18.5 16 14 18.5 14 23 16 23 18.5M20 21.08L15.92 17C15.65 17.42 15.5 17.94 15.5 18.5C15.5 20.16 16.84 21.5 18.5 21.5C19.06 21.5 19.58 21.35 20 21.08M21.5 18.5C21.5 16.84 20.16 15.5 18.5 15.5C17.94 15.5 17.42 15.65 17 15.92L21.08 20C21.35 19.58 21.5 19.06 21.5 18.5Z" />
                        </svg>
                        Annuler la commande
                    </x-back.form.button>
                @endif
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-8 lg:space-y-0 lg:space-x-8 lg:mb-8">
            <section class="px-4 py-3 w-full lg:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col lg:flex-row justify-between items-center pb-8 border-b dark:border-gray-700">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">Commande n°{{ $order->id }}</h2>
                        <p class="text-gray-500 text-sm">Enregistrée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                        <p class="text-gray-500 text-sm">
                            Dernière modification le {{ $order->updated_at->format('d/m/Y à H:i') }}
                        </p>
                    </article>
                    <article class="mb-2 lg:mb-0">
                        <p class="text-gray-500 text-sm">
                            <span class="rounded-full text-white bg-{{ $order->status->color }}-500 p-2">
                                {{ $order->status->name }}
                            </span>
                        </p>
                    </article>
                </div>

                <article class="pt-4 pb-8 border-b dark:border-gray-700 text-gray-500">
                    <h2 class="font-bold text-lg">Vêtements commandés</h2>

                    <table class="table w-full table-auto my-4">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-900">
                                <th class="py-3">Nom du vêtement</th>
                                <th class="py-3">Quantité</th>
                                <th class="py-3">Prix unitaire HT</th>
                                <th class="py-3">Prix unitaire TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="py-3 text-center">{{ $item->name }}</td>
                                    <td class="py-3 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 text-center">{{ $item->formatted_price_without_taxes }}€</td>
                                    <td class="py-3 text-center">{{ $item->formatted_price }}€</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="py-3" colspan="2"></td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-right font-bold">Montant total HT</td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-center font-bold">{{ $order->formatted_price_without_taxes }}€</td>
                            </tr>
                            <tr>
                                <td class="py-3" colspan="2"></td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-right font-bold">Total taxes</td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-center font-bold">{{ $order->formatted_total_taxes }}€</td>
                            </tr>
                            <tr>
                                <td class="py-3" colspan="2"></td>
                                <td class="py-3 text-right font-bold">Montant des frais de port TTC</td>
                                <td class="py-3 text-center font-bold">{{ $order->formatted_shipping_fees }}€</td>
                            </tr>
                            <tr>
                                <td class="py-3" colspan="2"></td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-right font-bold">Montant total TTC</td>
                                <td class="py-3 bg-gray-100 dark:bg-gray-900 text-center font-bold">{{ $order->formatted_price }}€</td>
                            </tr>
                            <tr>
                                <td class="py-3" colspan="3"></td>
                                <td class="py-3 text-right text-xs font-semibold uppercase">
                                    <span class="mr-2">&rarr; Frais Stripe {{ round(($order->formatted_price * 1.4 / 100) + .25, 2) }}€</span>
                                </td>
                                {{-- <td class="py-3 text-center text-xs font-semibold uppercase"></td> --}}
                            </tr>
                        </tbody>
                    </table>
                </article>

                <div class="mt-8">
                    @if (!$order->is_cancelled)
                        <p class="mb-4">Vous pouvez proposer un remboursement partiel au client en cliquant sur le lien ci-dessous.</p>
                        <div class="w-full flex justify-end">
                            <x-back.link-button href="#" class="bg-blue-500 text-white hover:bg-blue-600">
                                <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M18,11H6A2,2 0 0,0 4,13V21A2,2 0 0,0 6,23H18A2,2 0 0,0 20,21V13A2,2 0 0,0 18,11M18,21H6V17H18V21M18,15H6V13H18V15M17,5V10H15.5V6.5H9.88L12.3,8.93L11.24,10L7,5.75L11.24,1.5L12.3,2.57L9.88,5H17Z" />
                                </svg>
                                Effectuer un remboursement partiel
                            </x-back.link-button>
                        </div>
                    @endif
                </div>
            </section>

            <section class="px-4 py-3 w-full lg:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <h2 class="font-semibold uppercase text-gray-500">
                    Adresses
                </h2>

                <h3 class="font-semibold text-xs uppercase text-gray-500 mt-4">Adresse de livraison</h3>

                <div class="mt-4 flex flex-col space-y-4">
                    <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                            <span>{{ $order->address->firstname }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                            <span>{{ $order->address->lastname }}</span>
                        </span>
                    </article>

                    <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                            <span>{{ $order->address->street }} {{ $order->address->additionnal }}</span>
                        </span>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                            <span>{{ $order->address->city }} {{ $order->address->zipcode }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                            <span>{{ $order->address->country->name }}</span>
                        </span>
                    </article>

                    <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M16.79,23C16.37,22.83 16.07,22.45 16,22C15.95,21.74 16,21.56 16.4,20.84C17.9,18.14 18.67,15.09 18.63,12C18.67,9 17.94,6.07 16.5,3.44C16.29,3 16.1,2.58 15.94,2.13C16,1.75 16.19,1.4 16.5,1.19C16.95,0.95 17.5,1 17.91,1.28C18.19,1.64 18.43,2 18.63,2.42C19.71,4.5 20.44,6.7 20.8,9C21.03,10.81 21.06,12.65 20.89,14.47C20.58,16.81 19.89,19.07 18.83,21.18C18.19,22.46 17.83,23 17.45,23C17.37,23 17.28,23 17.2,23C17.06,23 16.93,23 16.79,23V23M12.43,20.79C11.86,20.63 11.5,20.05 11.62,19.47C11.62,19.35 11.93,18.8 12.21,18.24C13.39,15.97 13.9,13.41 13.67,10.86C13.53,9.03 13,7.25 12.13,5.64C11.5,4.38 11.46,4.18 11.83,3.64C12.27,3.15 13,3.08 13.54,3.5C14.26,4.56 14.83,5.72 15.25,6.94C16.53,10.73 16.33,14.86 14.69,18.5C13.85,20.39 13.26,21 12.43,20.74V20.79M7.93,18.56C7.57,18.4 7.3,18.08 7.2,17.7C7.2,17.5 7.2,17.24 7.65,16.44C9.14,13.74 9.14,10.46 7.65,7.76C7,6.5 7,6.24 7.53,5.76C7.72,5.54 8,5.43 8.3,5.47C8.94,5.47 9.3,5.78 9.84,6.91C10.69,8.47 11.13,10.22 11.12,12C11.16,13.81 10.72,15.61 9.85,17.2C9.31,18.25 9.04,18.5 8.5,18.59C8.31,18.61 8.11,18.59 7.93,18.5V18.56M3.72,16.43C3.39,16.27 3.13,16 3,15.65C2.9,15.3 3,15 3.4,14.36C3.9,13.68 4.14,12.84 4.09,12C4.16,11.15 3.93,10.31 3.44,9.61C3.27,9.36 3.13,9.09 3,8.82C2.89,8.19 3.31,7.59 4,7.47C4.54,7.37 4.92,7.6 5.42,8.36C6.87,10.57 6.87,13.42 5.42,15.63C4.91,16.4 4.33,16.63 3.73,16.43H3.72Z" />
                        </svg>
                        @if ($order->address->email)
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                                <span>{{ $order->address->email }}</span>
                            </span>
                        @endif
                        @if ($order->address->phone)
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                                <span>{{ $order->address->phone }}</span>
                            </span>
                        @endif
                    </article>
                </div>

                @if ($order->invoice)
                    <h3 class="font-semibold text-xs uppercase text-gray-500 mt-4">Adresse de facturation</h3>

                    <div class="mt-4 flex flex-col space-y-4">
                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                            </svg>
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                                <span>{{ $order->invoice->address->firstname }}</span>
                            </span>
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                                <span>{{ $order->invoice->address->lastname }}</span>
                            </span>
                        </article>

                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                            </svg>
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                                <span>{{ $order->invoice->address->street }} {{ $order->invoice->address->additionnal }}</span>
                            </span>
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                                <span>{{ $order->invoice->address->city }} {{ $order->invoice->address->zipcode }}</span>
                            </span>
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                                <span>{{ $order->invoice->address->country->name }}</span>
                            </span>
                        </article>

                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M16.79,23C16.37,22.83 16.07,22.45 16,22C15.95,21.74 16,21.56 16.4,20.84C17.9,18.14 18.67,15.09 18.63,12C18.67,9 17.94,6.07 16.5,3.44C16.29,3 16.1,2.58 15.94,2.13C16,1.75 16.19,1.4 16.5,1.19C16.95,0.95 17.5,1 17.91,1.28C18.19,1.64 18.43,2 18.63,2.42C19.71,4.5 20.44,6.7 20.8,9C21.03,10.81 21.06,12.65 20.89,14.47C20.58,16.81 19.89,19.07 18.83,21.18C18.19,22.46 17.83,23 17.45,23C17.37,23 17.28,23 17.2,23C17.06,23 16.93,23 16.79,23V23M12.43,20.79C11.86,20.63 11.5,20.05 11.62,19.47C11.62,19.35 11.93,18.8 12.21,18.24C13.39,15.97 13.9,13.41 13.67,10.86C13.53,9.03 13,7.25 12.13,5.64C11.5,4.38 11.46,4.18 11.83,3.64C12.27,3.15 13,3.08 13.54,3.5C14.26,4.56 14.83,5.72 15.25,6.94C16.53,10.73 16.33,14.86 14.69,18.5C13.85,20.39 13.26,21 12.43,20.74V20.79M7.93,18.56C7.57,18.4 7.3,18.08 7.2,17.7C7.2,17.5 7.2,17.24 7.65,16.44C9.14,13.74 9.14,10.46 7.65,7.76C7,6.5 7,6.24 7.53,5.76C7.72,5.54 8,5.43 8.3,5.47C8.94,5.47 9.3,5.78 9.84,6.91C10.69,8.47 11.13,10.22 11.12,12C11.16,13.81 10.72,15.61 9.85,17.2C9.31,18.25 9.04,18.5 8.5,18.59C8.31,18.61 8.11,18.59 7.93,18.5V18.56M3.72,16.43C3.39,16.27 3.13,16 3,15.65C2.9,15.3 3,15 3.4,14.36C3.9,13.68 4.14,12.84 4.09,12C4.16,11.15 3.93,10.31 3.44,9.61C3.27,9.36 3.13,9.09 3,8.82C2.89,8.19 3.31,7.59 4,7.47C4.54,7.37 4.92,7.6 5.42,8.36C6.87,10.57 6.87,13.42 5.42,15.63C4.91,16.4 4.33,16.63 3.73,16.43H3.72Z" />
                            </svg>
                            @if ($order->invoice->address->email)
                                <span class="mr-3">
                                    <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                                    <span>{{ $order->invoice->address->email }}</span>
                                </span>
                            @endif
                            @if ($order->invoice->address->phone)
                                <span>
                                    <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                                    <span>{{ $order->invoice->address->phone }}</span>
                                </span>
                            @endif
                        </article>
                    </div>
                @endif
            </section>
        </div>

    <x-back.modal>
        <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Êtes-vous sûr de vouloir annuler cette commande ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez annuler la commande en cours et effectuer un <strong>remboursement</strong> au client. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
            </p>
        </div>
        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-500 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Annuler
            </button>
            <form action="#" method="POST" class="inline delete-modal-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-modal-button w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                    J'annule la commande
                </button>
            </form>
        </footer>
    </x-back.modal>

@endsection
