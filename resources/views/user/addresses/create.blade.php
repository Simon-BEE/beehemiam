@extends('layouts.app')

@section('meta-title')
    Ajouter une nouvelle adresse
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <a href="{{ route('user.addresses.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mes adresses</a>
        <span class="text-gray-500">/</span>
        <p>Ajouter une nouvelle adresse</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Ajouter une nouvelle adresse</h2>
                <p class="text-sm">Créer une nouvelle adresse de livraison ou de facturation.</p>
            </div>
        </div>

        <x-form.form method="POST" action="{{ route('user.addresses.store') }}" class="pr-3 py-2 my-6 w-full flex flex-col">

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
                <x-form.input 
                    classDiv="w-full"
                    name="firstname"
                    type="text"
                    label="Prénom"
                    placeholder="Prénom"
                    value="{{ old('firstname') ?? $user->firstname }}"
                    required
                />
                <x-form.input 
                    classDiv="w-full"
                    name="lastname"
                    type="text"
                    label="Nom de famille"
                    placeholder="Nom de famille"
                    value="{{ old('lastname') ?? $user->lastname }}"
                    required
                />
            </div>

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
                <x-form.input 
                    classDiv="w-full"
                    name="email"
                    type="email"
                    label="Adresse email"
                    placeholder="Adresse email"
                    value="{{ old('email') ?? $user->email }}"
                />
                <x-form.input 
                    classDiv="w-full"
                    name="phone"
                    type="text"
                    label="Numéro de télephone"
                    placeholder="Numéro de télephone"
                    value="{{ old('phone') }}"
                />
            </div>

            <x-form.input 
                name="street"
                type="text"
                label="Adresse"
                placeholder="Adresse"
                value="{{ old('street') }}"
                required
            />

            <x-form.input 
                name="additionnal"
                type="text"
                label="Complément d'adresse"
                placeholder="Complément d'adresse"
                value="{{ old('additionnal') }}"
            />

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
                <x-form.input 
                    classDiv="w-full"
                    name="city"
                    type="text"
                    label="Ville"
                    placeholder="Ville"
                    value="{{ old('city') }}"
                    required
                />

                <x-form.input 
                    classDiv="w-full"
                    name="zipcode"
                    type="text"
                    label="Code postal"
                    placeholder="Code postal"
                    value="{{ old('zipcode') }}"
                    required
                />

                <x-form.select label="Choisir un pays" name="country_id" required>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </x-form.select>
            </div>

            @if ($user->addresses->isNotEmpty())
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 my-4">
                    <x-form.switch name="is_main" classDiv="">
                        Définir comme adresse par défaut
                    </x-form.switch>

                    <x-form.switch name="is_billing" classDiv="">
                        Définir comme adresse de facturation
                    </x-form.switch>
                </div>
            @endif

            <x-form.input 
                name="name"
                type="text"
                label="Nom de l'adresse"
                placeholder="Nom de l'adresse"
                value="{{ old('name') }}"
                helper="Si vous souhaitez donner un nom à cette adresse, par exemple : 'Maison'"
            />
        
            
            <div class="text-right mt-6">
                <x-form.button>
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                    </svg>
                    Enregistrer cette adresse
                </x-form.button>
            </div>
        </x-form.form>
</x-layouts.user>

@endsection