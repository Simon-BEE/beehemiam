@extends('layouts.app')

@section('meta-title')
    Mon compte
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <p>Mon compte</p>
        <span class="text-gray-500">/</span>
        <p>Tableau de bord</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Mon compte</h2>
                <p class="text-sm">Gérer mes informations personnelles et mes préférences.</p>
            </div>
        </div>

        <section class="pr-3 py-2 my-6 flex flex-col space-y-3">
            <p>
                <span class="uppercase text-xs mr-2">Prénom</span>
                <span class="font-semibold">{{ $user->firstname }}</span>
            </p>

            <p>
                <span class="uppercase text-xs mr-2">Nom de famille</span>
                <span class="font-semibold">{{ $user->lastname }}</span>
            </p>

            <div>
                <span class="uppercase text-xs mr-2">Adresse email</span>
                <span class="font-semibold">{{ $user->email }}</span>
                @if (!$user->email_verified_at)
                    <x-form.form action="{{ route('user.profile.email-verification') }}" method="POST" class="inline-flex mt-3 md:mt-0">
                        <button class="ml-4 px-2 py-1 inline-flex items-center bg-primary-300 text-sm focus:outline-none">
                            <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                            Adresse email non vérifiée
                        </button>
                    </x-form.form>
                @endif
            </div>

            <div>
                <p class="flex items-center mt-2">
                    <span class="uppercase text-xs mr-2">Reçoit la newsletter</span>
                    <span class="font-semibold">
                        @if ($user->newsletter)
                            <svg class="h-4 w-4 text-green-200" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                            </svg>
                        @else
                            <svg class="h-4 w-4 text-red-300" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                        @endif
                    </span>
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6 pt-6">
                <a href="{{ route('user.profile.edit') }}" class="flex items-center rounded p-2 bg-primary-200 transition-colors duration-200 hover:bg-primary-700 font-semibold">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M2 17V20H10V18.11H3.9V17C3.9 16.36 7.03 14.9 10 14.9C10.96 14.91 11.91 15.04 12.83 15.28L14.35 13.76C12.95 13.29 11.5 13.03 10 13C7.33 13 2 14.33 2 17M10 4C7.79 4 6 5.79 6 8S7.79 12 10 12 14 10.21 14 8 12.21 4 10 4M10 10C8.9 10 8 9.11 8 8S8.9 6 10 6 12 6.9 12 8 11.11 10 10 10M21.7 13.35L20.7 14.35L18.65 12.35L19.65 11.35C19.86 11.14 20.21 11.14 20.42 11.35L21.7 12.63C21.91 12.84 21.91 13.19 21.7 13.4M12 18.94L18.06 12.88L20.11 14.88L14.11 20.95H12V18.94" />
                    </svg>
                    Modifier mes informations
                </a>

                <a href="{{ route('user.profile.edit.password') }}" class="flex items-center rounded p-2 transition-colors bg-primary-200 duration-200 hover:bg-primary-700 font-semibold">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5.83,10C5.42,8.83 4.31,8 3,8A3,3 0 0,0 0,11A3,3 0 0,0 3,14C4.31,14 5.42,13.17 5.83,12H8V14H10V12H11V10H5.83M3,12A1,1 0 0,1 2,11A1,1 0 0,1 3,10A1,1 0 0,1 4,11A1,1 0 0,1 3,12M16,4A4,4 0 0,0 12,8A4,4 0 0,0 16,12A4,4 0 0,0 20,8A4,4 0 0,0 16,4M16,10.1A2.1,2.1 0 0,1 13.9,8A2.1,2.1 0 0,1 16,5.9C17.16,5.9 18.1,6.84 18.1,8C18.1,9.16 17.16,10.1 16,10.1M16,13C13.33,13 8,14.33 8,17V20H24V17C24,14.33 18.67,13 16,13M22.1,18.1H9.9V17C9.9,16.36 13,14.9 16,14.9C18.97,14.9 22.1,16.36 22.1,17V18.1Z" />
                    </svg>
                    Modifier mon mot de passe
                </a>
            </div>
        </section>

        <section class="mt-12 mb-8">
            @if ($user->addresses->isNotEmpty())
                <div class="relative border border-primary-400 p-4 rounded-sm w-full md:w-1/2 flex flex-col space-y-2">

                    <h3 class="absolute -top-4 py-1 px-4 bg-primary-100 uppercase text-sm">Adresse par défaut</h3>

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                            <span>{{ $user->address->firstname }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                            <span>{{ $user->address->lastname }}</span>
                        </span>
                    </article>

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                            <span>{{ $user->address->street }} {{ $user->address->additionnal }}</span>
                        </span>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                            <span>{{ $user->address->city }} {{ $user->address->zipcode }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                            <span>{{ $user->address->country->name }}</span>
                        </span>
                    </article>

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                        </svg>
                        @if ($user->address->email)
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                                <span>{{ $user->address->email }}</span>
                            </span>
                        @endif
                        @if ($user->address->phone)
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                                <span>{{ $user->address->phone }}</span>
                            </span>
                        @endif
                    </article>
                </div>

                <a href="{{ route('user.addresses.index') }}" class="my-4 inline-flex items-center rounded p-2 transition-colors bg-primary-200 duration-200 hover:bg-primary-700 font-semibold">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 3L2 12H5V20H11V14H13V16.11L15 14.11V12H9V18H7V10.19L12 5.69L17 10.19V12.11L19.43 9.68L12 3M21.04 11.14C20.9 11.14 20.76 11.2 20.65 11.3L19.65 12.3L21.7 14.35L22.7 13.35C22.91 13.14 22.91 12.79 22.7 12.58L21.42 11.3C21.32 11.2 21.18 11.14 21.04 11.14M19.06 12.88L13 18.94V21H15.06L21.11 14.93L19.06 12.88Z" />
                    </svg>
                    Modifier ou ajouter une adresse
                </a>
            @else
                <p class="mt-10 mb-12">Vous n'avez enregistré aucune adresse par défaut. <a href="{{ route('user.addresses.index') }}" class="text-kaki-800 underline">Ajouter une adresse</a>.</p>
            @endif
        </section>

        @if ($lastOrder)
            <section>
                <article class="w-full md:w-2/3 flex flex-col md:flex-row items-start">
                    <div class="w-full md:w-1/2">
                        <img src="https://source.unsplash.com/300x300/daily?clothes" alt="random photo">
                    </div>

                    <div class="w-full md:w-1/2 md:pl-6 flex flex-col">
                        <h4 class="font-bold text-lg">Commande effectuée le {{ $lastOrder->created_at->format('d/m/Y') }}</h4>
                        <p class="my-4">{{ $lastOrder->verbose_status }}</p>
                        <table class="w-full">
                            <tbody>
                                @foreach ($lastOrder->orderItems as $item)
                                    <tr>
                                        <td class="py-2 pr-3">{{ $item->name }}</td>
                                        <td class="py-2 pr-3">{{ $item->quantity }}</td>
                                        <td class="py-2 pr-3">{{ $item->formatted_price }}€</td>
                                    </tr>
                                @endforeach
                                <tr class="border-t border-primary-400 bg-primary-200">
                                    <td class="py-2 pr-3">Total TTC</td>
                                    <td class="py-2 pr-3"></td>
                                    <td class="py-2 pr-3">{{ $lastOrder->formatted_price }}€</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-4 md:mt-20 text-right">
                            <a href="{{ $lastOrder->path }}" class="text-primary-500 hover:underline">Plus de détails</a>
                        </p>
                    </div>
                </article>

                <a href="{{ route('user.orders.index') }}" class="my-4 inline-flex items-center rounded p-2 transition-colors bg-primary-200 duration-200 hover:bg-primary-700 font-semibold">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13.04 10C12.64 10.25 12.26 10.55 11.9 10.9C11.57 11.24 11.27 11.61 11.03 12H8V10.5C8 10.22 8.22 10 8.5 10H13.04M20 8H2V2H20V8M18 4H4V6H18V4M5 18V9H3V20H11.82C11.24 19.4 10.8 18.72 10.5 18H5M23.39 21L22 22.39L18.88 19.32C18.19 19.75 17.37 20 16.5 20C14 20 12 18 12 15.5S14 11 16.5 11 21 13 21 15.5C21 16.38 20.75 17.21 20.31 17.9L23.39 21M19 15.5C19 14.12 17.88 13 16.5 13S14 14.12 14 15.5 15.12 18 16.5 18 19 16.88 19 15.5Z" />
                    </svg>
                    Voir toutes mes commandes
                </a>
            </section>

        @else
            <x-info>
                <p>Aucun historique de commande à afficher pour le moment 😏</p>
            </x-info>
        @endif


    </section>
</x-layouts.user>

@endsection
