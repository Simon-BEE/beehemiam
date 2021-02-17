@extends('layouts.app')

@section('meta-title')
    Mon compte
@endsection

@section('content')

<section class="flex flex-col md:flex-row items-start">
    <aside class="w-full md:w-1/4 bg-primary-300 pt-5 px-5 pb-32">
        <p>Mes informations personnelles</p>
        <p>Modifier mon mot de passe</p>
        <p>Mes adresses</p>
        <p>Mon historique de commande</p>
    </aside>

    <div class="w-full md:w-3/4 p-5">
        <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            {{-- <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span> --}}
            <p>Mon compte</p>
        </section>

        <section class="">
            <div class="title pb-3 border-b flex items-start justify-between">
                <div class="">
                    <h2 class="font-bold text-2xl">Mon compte</h2>
                    <p class="text-sm">Gérer mes informations personnelles et mes préférences.</p>
                </div>
            </div>

            <article class="px-3 py-2 my-6 flex flex-col space-y-3">
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
                    <x-form.form action="#" method="POST" class="inline-flex mt-3 md:mt-0">
                        <button class="ml-4 px-2 py-1 inline-flex items-center bg-primary-300 text-sm">
                            <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                            Adresse email non vérifiée
                        </button>
                    </x-form.form>
                </div>

                {{-- NEWSLETTER --}}

                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6 pt-6">
                    <a href="#" class="flex items-center rounded p-2 bg-primary-200 border border-transparent transition-colors duration-200 hover:border-primary-700">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M2 17V20H10V18.11H3.9V17C3.9 16.36 7.03 14.9 10 14.9C10.96 14.91 11.91 15.04 12.83 15.28L14.35 13.76C12.95 13.29 11.5 13.03 10 13C7.33 13 2 14.33 2 17M10 4C7.79 4 6 5.79 6 8S7.79 12 10 12 14 10.21 14 8 12.21 4 10 4M10 10C8.9 10 8 9.11 8 8S8.9 6 10 6 12 6.9 12 8 11.11 10 10 10M21.7 13.35L20.7 14.35L18.65 12.35L19.65 11.35C19.86 11.14 20.21 11.14 20.42 11.35L21.7 12.63C21.91 12.84 21.91 13.19 21.7 13.4M12 18.94L18.06 12.88L20.11 14.88L14.11 20.95H12V18.94" />
                        </svg>
                        Modifier mes informations
                    </a>

                    <a href="#" class="flex items-center rounded p-2 transition-colors border border-transparent bg-primary-200 duration-200 hover:border-primary-700">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M5.83,10C5.42,8.83 4.31,8 3,8A3,3 0 0,0 0,11A3,3 0 0,0 3,14C4.31,14 5.42,13.17 5.83,12H8V14H10V12H11V10H5.83M3,12A1,1 0 0,1 2,11A1,1 0 0,1 3,10A1,1 0 0,1 4,11A1,1 0 0,1 3,12M16,4A4,4 0 0,0 12,8A4,4 0 0,0 16,12A4,4 0 0,0 20,8A4,4 0 0,0 16,4M16,10.1A2.1,2.1 0 0,1 13.9,8A2.1,2.1 0 0,1 16,5.9C17.16,5.9 18.1,6.84 18.1,8C18.1,9.16 17.16,10.1 16,10.1M16,13C13.33,13 8,14.33 8,17V20H24V17C24,14.33 18.67,13 16,13M22.1,18.1H9.9V17C9.9,16.36 13,14.9 16,14.9C18.97,14.9 22.1,16.36 22.1,17V18.1Z" />
                        </svg>
                        Modifier mon mot de passe
                    </a>
                </div>
            </article>

            <article class="my-8">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita maxime mollitia animi sit ipsam enim dolorum laborum obcaecati iure iusto quis vero nihil debitis consequuntur ad, eaque incidunt similique itaque.
            </article>
        </section>
    </div>
</section>

@endsection