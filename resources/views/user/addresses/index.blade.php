@extends('layouts.app')

@section('meta-title')
    Mes adresses
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <p>Mes adresses</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex flex-col md:flex-row items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Mes adresses</h2>
                <p class="text-sm">Mes adresses de livraison ou de facturation.</p>
            </div>
            <a href="{{ route('user.addresses.create') }}" class="my-4 inline-flex items-center rounded p-2 transition-colors bg-primary-200 duration-200 hover:bg-primary-700 font-semibold">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 3L2 12H5V20H11V14H13V16.11L15 14.11V12H9V18H7V10.19L12 5.69L17 10.19V12.11L19.43 9.68L12 3M21.04 11.14C20.9 11.14 20.76 11.2 20.65 11.3L19.65 12.3L21.7 14.35L22.7 13.35C22.91 13.14 22.91 12.79 22.7 12.58L21.42 11.3C21.32 11.2 21.18 11.14 21.04 11.14M19.06 12.88L13 18.94V21H15.06L21.11 14.93L19.06 12.88Z" />
                </svg>
                Ajouter une nouvelle adresse
            </a>
        </div>

        <section class="flex flex-col md:flex-row justify-between md:space-x-4 space-y-4 md:space-y-0 py-8">
            @forelse ($addresses as $address)
                <div class="relative border border-primary-400 p-4 rounded-sm w-full md:w-1/2 flex flex-col space-y-2">
                    @if ($address->is_main)
                        <h3 class="absolute -top-3 py-1 px-4 bg-primary-100 uppercase text-sm">Adresse par défaut</h3>
                    @endif

                    <div class="absolute {{ $address->is_main ? '-top-7' : '-top-5' }} right-1 py-1 px-4 bg-primary-100 flex items-center space-x-1">
                        @if (!$address->is_main)
                            <x-form.form method="PATCH" action="{{ route('user.addresses.update.main', $address) }}" class="inline-flex">
                                <button class="px-2 py-1 rounded hover:bg-primary-300" title="Définir comme adresse par défaut">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,19H5V5H15V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V11H19M7.91,10.08L6.5,11.5L11,16L21,6L19.59,4.58L11,13.17L7.91,10.08Z" />
                                    </svg>
                                </button>
                            </x-form.form>
                        @endif
                        <a href="{{ route('user.addresses.edit', $address) }}" class="px-2 py-1 rounded hover:bg-primary-300" title="Éditer">
                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </a>
                        <open-modal-button 
                            classes="modal-button px-2 py-1 rounded hover:bg-primary-300"
                            route="{{ route('user.addresses.destroy', $address) }}" 
                            title="Supprimer"
                        >
                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                            </svg>
                        </open-modal-button>
                    </div>

                    @if ($address->is_main || $address->is_billing)
                        <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                            @if ($address->is_main)
                                <div class="">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                                    </svg>
                                </div>
                            @endif

                            @if ($address->is_billing)
                                <div class="">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    @endif

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                            <span>{{ $address->firstname }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                            <span>{{ $address->lastname }}</span>
                        </span>
                    </article>

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                            <span>{{ $address->street }} {{ $address->additionnal }}</span>
                        </span>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                            <span>{{ $address->city }} {{ $address->zipcode }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                            <span>{{ $address->country->name }}</span>
                        </span>
                    </article>

                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                        </svg>
                        @if ($address->email)
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                                <span>{{ $address->email }}</span>
                            </span>
                        @endif
                        @if ($address->phone)
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                                <span>{{ $address->phone }}</span>
                            </span>
                        @endif
                    </article>
                </div>
            @empty
                <p class="w-full my-4 text-center">
                    Vous n'avez enregistré aucune adresse. 
                    <a href="{{ route('user.addresses.create') }}" class="text-primary-500 hover:underline">Ajoutez en une</a>.
                </p>
            @endforelse
        </section>
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
        <x-form.form method="DELETE" action="#" class="modal-form inline-flex">
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

@push('scripts')

    <script>
        const modalForm = document.querySelector('.modal-form');

        document.querySelectorAll('.modal-button').forEach(button => {
            button.addEventListener('click', () => {
                modalForm.action = button.getAttribute('data-route');
            });
        });
    </script>
    
@endpush