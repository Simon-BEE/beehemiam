@extends('layouts.back')

@section('meta-title')
    Voir le client : {{ $user->full_name }}
@endsection

@section('content')
    <div class="container grid px-2 md:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.users.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les clients</a>
            <span class="text-gray-500">/</span>
            <p>Voir le client : {{ $user->full_name }}</p>
        </section>

        <div class="title my-6 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center">
                <span class="icon text-indigo-500">
                    <svg class="w-20 h-20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
                    </svg>
                </span>
                <div class="ml-4">
                    <h2 class="font-bold text-2xl text-gray-700 dark:text-gray-300">{{ $user->full_name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>

            <div class="actions flex flex-col md:flex-row items-center space-y-1 md:space-y-0 md:space-x-1">
                <x-back.link-button href="{{ route('admin.categories.create') }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21.7,13.35L20.7,14.35L18.65,12.3L19.65,11.3C19.86,11.09 20.21,11.09 20.42,11.3L21.7,12.58C21.91,12.79 21.91,13.14 21.7,13.35M12,18.94L18.06,12.88L20.11,14.93L14.06,21H12V18.94M12,14C7.58,14 4,15.79 4,18V20H10V18.11L14,14.11C13.34,14.03 12.67,14 12,14M12,4A4,4 0 0,0 8,8A4,4 0 0,0 12,12A4,4 0 0,0 16,8A4,4 0 0,0 12,4Z" />
                    </svg>
                    Éditer
                </x-back.link-button>
                <x-back.link-button href="{{ route('admin.categories.create') }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                    </svg>
                    Voir les commandes
                </x-back.link-button>
                <x-back.form.button 
                    class="text-white bg-red-500 hover:bg-red-600"
                    @click="changeModalButtonLink(`#`);openModal();" 
                    aria-label="Delete"
                >
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Supprimer
                </x-back.form.button>
            </div>
        </div>

        <section class="px-4 py-3 mb-8 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
            <h2 class="font-semibold text-xs uppercase text-gray-500">
                Résumé de l'activité
            </h2>

            <div class="flex flex-col md:flex-row items-center justify-around text-center dark:text-gray-400">
                <article class="w-full md:w-1/4 py-6">
                    <h3 class="font-bold text-4xl">5</h3>
                    <h4 class="text-xl font-semibold"> commandes</h4>
                </article>
                <article class="w-full md:w-1/4 py-6 md:border-l-2 md:border-r-2">
                    <h3 class="font-bold text-4xl">12</h3>
                    <h4 class="text-xl font-semibold"> vêtements achetés</h4>
                </article>
                <article class="w-full md:w-1/4 py-6">
                    <h3 class="font-bold text-4xl">945€</h3>
                    <h4 class="text-xl font-semibold"> dépensés</h4>
                </article>
            </div>

            {{-- <p class="text-center">Le client n'a jamais passé commande sur le site.</p> --}}
        </section>

        <div class="flex flex-col md:flex-row justify-between items-start space-y-8 md:space-y-0 md:space-x-8 md:mb-8">
            <section class="px-4 py-3 w-full md:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <article class="pb-8 border-b dark:border-gray-700">
                    <h2 class="font-bold text-lg">{{ $user->full_name }}</h2>
                    <p class="text-gray-500 text-sm">Inscrit depuis le {{ $user->created_at->format('d/m/Y à H:00') }}</p>
                    <p class="text-gray-500 text-sm">
                        Dernière activité enregistré le {{ $user->last_activity_at ? $user->last_activity_at->format('d/m/Y à H:i') : 'Jamais connecté' }}
                    </p>
                </article>

                <article class="my-8 pb-8 border-b dark:border-gray-700">
                    <p class="flex items-center">
                        @if ($user->newsletter)
                            <svg class="w-5 h-5 mr-3 text-green-500" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-3 text-red-500" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                        @endif
                        <span class="text-gray-700 dark:text-gray-300">Abonné à la newsletter</span>
                    </p>
                    <p class="flex items-center mt-1">
                        @if ($user->email_verified_at)
                            <svg class="w-5 h-5 mr-3 text-green-500" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-3 text-red-500" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                        @endif
                        <span class="text-gray-700 dark:text-gray-300">Adresse email vérifiée</span>
                    </p>
                </article>

                <article class="pb-8 text-gray-500">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
                        </svg>
                        <a href="mailto:{{ $user->email }}" class="hover:underline">{{ $user->email }}</a>
                    </p>
                    @if ($user->addresses->isNotEmpty() && $user->address->phone)
                        <p class="flex items-center mt-1">
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17,19H7V5H17M17,1H7C5.89,1 5,1.89 5,3V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V3C19,1.89 18.1,1 17,1Z" />
                            </svg>
                            <a href="tel:{{ $user->address->phone }}" class="hover:underline">{{ $user->address->phone }}</a>
                        </p>
                    @endif
                </article>
            </section>

            <section class="px-4 py-3 w-full md:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <h2 class="font-semibold text-xs uppercase text-gray-500">
                    Adresse par défaut
                </h2>

                @if ($user->addresses->isNotEmpty())
                    <div class="mt-4 flex flex-col space-y-4">
                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                            </svg>
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                                <span>{{ $user->firstname }}</span>
                            </span>
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                                <span>{{ $user->lastname }}</span>
                            </span>
                        </article>

                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
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

                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M16.79,23C16.37,22.83 16.07,22.45 16,22C15.95,21.74 16,21.56 16.4,20.84C17.9,18.14 18.67,15.09 18.63,12C18.67,9 17.94,6.07 16.5,3.44C16.29,3 16.1,2.58 15.94,2.13C16,1.75 16.19,1.4 16.5,1.19C16.95,0.95 17.5,1 17.91,1.28C18.19,1.64 18.43,2 18.63,2.42C19.71,4.5 20.44,6.7 20.8,9C21.03,10.81 21.06,12.65 20.89,14.47C20.58,16.81 19.89,19.07 18.83,21.18C18.19,22.46 17.83,23 17.45,23C17.37,23 17.28,23 17.2,23C17.06,23 16.93,23 16.79,23V23M12.43,20.79C11.86,20.63 11.5,20.05 11.62,19.47C11.62,19.35 11.93,18.8 12.21,18.24C13.39,15.97 13.9,13.41 13.67,10.86C13.53,9.03 13,7.25 12.13,5.64C11.5,4.38 11.46,4.18 11.83,3.64C12.27,3.15 13,3.08 13.54,3.5C14.26,4.56 14.83,5.72 15.25,6.94C16.53,10.73 16.33,14.86 14.69,18.5C13.85,20.39 13.26,21 12.43,20.74V20.79M7.93,18.56C7.57,18.4 7.3,18.08 7.2,17.7C7.2,17.5 7.2,17.24 7.65,16.44C9.14,13.74 9.14,10.46 7.65,7.76C7,6.5 7,6.24 7.53,5.76C7.72,5.54 8,5.43 8.3,5.47C8.94,5.47 9.3,5.78 9.84,6.91C10.69,8.47 11.13,10.22 11.12,12C11.16,13.81 10.72,15.61 9.85,17.2C9.31,18.25 9.04,18.5 8.5,18.59C8.31,18.61 8.11,18.59 7.93,18.5V18.56M3.72,16.43C3.39,16.27 3.13,16 3,15.65C2.9,15.3 3,15 3.4,14.36C3.9,13.68 4.14,12.84 4.09,12C4.16,11.15 3.93,10.31 3.44,9.61C3.27,9.36 3.13,9.09 3,8.82C2.89,8.19 3.31,7.59 4,7.47C4.54,7.37 4.92,7.6 5.42,8.36C6.87,10.57 6.87,13.42 5.42,15.63C4.91,16.4 4.33,16.63 3.73,16.43H3.72Z" />
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

                        <article class="p-3 bg-gray-100 dark:bg-gray-900 flex items-center flex-wrap rounded">
                            <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z" />
                            </svg>
                            <span class="inline-flex items-end">
                                <span class="mr-2 text-xs uppercase text-gray-500">Adresse de facturation</span>
                                @if ($user->address->is_billing)
                                    <svg class="w-5 h-5 text-green-500" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-red-500" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                                    </svg>
                                @endif
                            </span>
                        </article>
                    </div>
                @else
                    <p class="text-center my-4">Le client n'a enregistré aucune adresse par défaut.</p>
                @endif
            </section>
        </div>
@endsection