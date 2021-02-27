@extends('layouts.app')

@section('meta-title')
    Modifier mes informations personnelles
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <p>Modifier mes informations personnelles</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Mes informations personnelles</h2>
                <p class="text-sm">Mettre à jour mes informations personnelles.</p>
            </div>
        </div>

        <x-form.form method="PATCH" action="{{ route('user.profile.update') }}" class="pr-3 py-2 my-6 w-full md:w-1/2 flex flex-col">

            <x-form.input 
                name="firstname"
                type="text"
                label="Prénom"
                placeholder="Votre prénom"
                value="{{ $user->firstname }}"
                required
            />
            <x-form.input 
                name="lastname"
                type="text"
                label="Nom de famille"
                placeholder="Votre nom de famille"
                value="{{ $user->lastname }}"
                required
            />
            <x-form.input 
                name="email"
                type="email"
                label="Adresse email"
                placeholder="Votre adresse email"
                value="{{ $user->email }}"
                required
            />
        
            <x-form.switch name="newsletter" isCheck="{{ $user->newsletter }}">
                Abonné à la newsletter
            </x-form.switch>
            
            <div class="text-right mt-6">
                <x-form.button>
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                    </svg>
                    Enregistrer les modifications
                </x-form.button>
            </div>
        </x-form.form>

    </section>
</x-layouts.user>

@endsection