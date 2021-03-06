@extends('layouts.app')

@section('meta-title')
    Modifier une adresse
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
        <p>Modifier une adresse</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex flex-col md:flex-row items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Modifier une adresse</h2>
                <p class="text-sm">Modifier une adresse de livraison ou de facturation.</p>
            </div>
            <div class="text-sm md:self-end flex items-center">
                @if ($address->is_main)
                    <span class="mr-2">Adresse par défaut</span>
                @endif
                {{-- <button class="modal-button text-red-400 flex items-center px-2 py-1 rounded hover:bg-primary-200">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                    </svg>
                    Supprimer cette adresse
                </button> --}}
                <open-modal-button 
                    classes="modal-button text-red-400 flex items-center px-2 py-1 rounded hover:bg-primary-200"
                    title="Supprimer"
                >
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                    </svg>
                    Supprimer cette adresse
                </open-modal-button>
            </div>
        </div>

        <x-form.form method="PATCH" action="{{ route('user.addresses.update', $address) }}" class="pr-3 py-2 my-6 w-full flex flex-col">

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
                <x-form.input 
                    classDiv="w-full"
                    name="firstname"
                    type="text"
                    label="Prénom"
                    placeholder="Prénom"
                    value="{{ old('firstname') ?? $address->firstname }}"
                    required
                />
                <x-form.input 
                    classDiv="w-full"
                    name="lastname"
                    type="text"
                    label="Nom de famille"
                    placeholder="Nom de famille"
                    value="{{ old('lastname') ?? $address->lastname }}"
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
                    value="{{ old('email') ?? $address->email }}"
                />
                <x-form.input 
                    classDiv="w-full"
                    name="phone"
                    type="text"
                    label="Numéro de télephone"
                    placeholder="Numéro de télephone"
                    value="{{ old('phone') ?? $address->phone }}"
                />
            </div>

            <x-form.input 
                name="street"
                type="text"
                label="Adresse"
                placeholder="Adresse"
                value="{{ old('street') ?? $address->street }}"
                required
            />

            <x-form.input 
                name="additionnal"
                type="text"
                label="Complément d'adresse"
                placeholder="Complément d'adresse"
                value="{{ old('additionnal') ?? $address->additionnal }}"
            />

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
                <x-form.input 
                    classDiv="w-full"
                    name="city"
                    type="text"
                    label="Ville"
                    placeholder="Ville"
                    value="{{ old('city') ?? $address->city }}"
                    required
                />

                <x-form.input 
                    classDiv="w-full"
                    name="zipcode"
                    type="text"
                    label="Code postal"
                    placeholder="Code postal"
                    value="{{ old('zipcode') ?? $address->zipcode }}"
                    required
                />

                <x-form.select label="Choisir un pays" name="country_id" required>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" {{ $address->country_id === $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
                @if (!$address->is_main)
                <x-form.switch name="is_main" classDiv="my-4" isCheck="{{ $address->is_main }}">
                    Définir comme adresse par défaut
                </x-form.switch>
                @endif
                
                @if (!$address->is_billing)
                    <x-form.switch name="is_billing" classDiv="my-4" isCheck="{{ $address->is_billing }}">
                        Définir comme adresse de facturation
                    </x-form.switch>
                @endif
            </div>

            <x-form.input 
                name="name"
                type="text"
                label="Nom de l'adresse"
                placeholder="Nom de l'adresse"
                value="{{ old('name') ?? $address->name }}"
                helper="Si vous souhaitez donner un nom à cette adresse, par exemple : 'Maison'"
            />
        
            
            <div class="text-right mt-6">
                <x-form.button>
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                    </svg>
                    Enregistrer les modifications
                </x-form.button>
            </div>
        </x-form.form>
</x-layouts.user>

@endsection

@push('modal')
<x-modal>
    <div class="w-full text-kaki-800 flex flex-col space-y-4">
        <h3 class="text-2xl font-bold">Suppression d'une adresse</h3>
        <p>En confirmant cette action, vous allez supprimer cette adresse. Vous ne pourrez plus la récupérer. Si c'est une erreur, vous pouvez cliquer sur le bouton <strong>Annuler</strong> ci-dessous.</p>
    </div>
    <div class="mt-12 flex justify-end items-center">
        <close-modal-button classes="bg-primary-200 rounded px-3 py-2 hover:bg-primary-300 inline-flex items-center mr-4">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
            </svg>
            Annuler
        </close-modal-button>
        <x-form.form method="DELETE" action="{{ route('user.addresses.destroy', $address) }}" class="modal-form inline-flex">
            <button class="inline-flex items-center rounded p-2 transition-colors text-white bg-red-500 duration-200 hover:bg-red-600 font-semibold">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                </svg>
                Je veux supprimer définitivement cette adresse
            </button>
        </x-form.form>
    </div>
</x-modal>
@endpush