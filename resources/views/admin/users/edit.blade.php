@extends('layouts.back')

@section('meta-title')
    Modifier le client : {{ $user->full_name }}
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.users.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les clients</a>
            <span class="text-gray-500">/</span>
            <p>Modifier le client : {{ $user->full_name }}</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
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

            <div class="actions flex flex-col lg:flex-row items-center space-y-1 lg:space-y-0 lg:space-x-1">
                <x-back.link-button href="{{ route('admin.users.show', $user) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5,12C18,12 20,14 20,16.5C20,17.38 19.75,18.21 19.31,18.9L22.39,22L21,23.39L17.88,20.32C17.19,20.75 16.37,21 15.5,21C13,21 11,19 11,16.5C11,14 13,12 15.5,12M15.5,14A2.5,2.5 0 0,0 13,16.5A2.5,2.5 0 0,0 15.5,19A2.5,2.5 0 0,0 18,16.5A2.5,2.5 0 0,0 15.5,14M10,4A4,4 0 0,1 14,8C14,8.91 13.69,9.75 13.18,10.43C12.32,10.75 11.55,11.26 10.91,11.9L10,12A4,4 0 0,1 6,8A4,4 0 0,1 10,4M2,20V18C2,15.88 5.31,14.14 9.5,14C9.18,14.78 9,15.62 9,16.5C9,17.79 9.38,19 10,20H2Z" />
                    </svg>
                    Voir le profil
                </x-back.link-button>
                <x-back.link-button href="{{ route('admin.users.orders', $user) }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400">
                    <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                    </svg>
                    Voir les commandes
                </x-back.link-button>
                <x-back.form.button 
                    class="text-white bg-red-500 hover:bg-red-600"
                    @click="changeModalButtonLink(`{{ route('admin.users.destroy', $user) }}`);openModal();" 
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

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-8 lg:space-y-0 lg:space-x-8 lg:mb-8">

            <section class="px-4 py-3 w-full lg:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <h2 class="font-semibold text-xs uppercase text-gray-500 mb-4">
                    Informations générales
                </h2>

                <x-form.form method="PATCH" action="{{ route('admin.users.update', $user) }}">

                    <x-back.form.input 
                        name="firstname"
                        type="text"
                        label="Prénom"
                        placeholder="Prénom"
                        value="{{ $user->firstname }}"
                        required
                    />

                    <x-back.form.input 
                        name="lastname"
                        type="text"
                        label="Nom de famille"
                        placeholder="Nom de famille"
                        value="{{ $user->lastname }}"
                        required
                    />

                    <x-back.form.input 
                        name="email"
                        type="email"
                        label="Adresse email"
                        placeholder="Adresse email"
                        value="{{ $user->email }}"
                        required
                    />
        
                    <x-back.form.switch 
                        name="newsletter"
                        isCheck="{{ $user->newsletter }}"
                    >
                        Reçoit la newsletter
                    </x-back.form.switch>

                    <div class="flex justify-end mt-4 save-button">
                        <x-back.form.button>
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                            </svg>
                            Enregistrer les informations
                        </x-back.form.button>
                    </div>

                </x-form.form>
                
            </section>

            <section class="px-4 py-3 w-full lg:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <h2 class="font-semibold text-xs uppercase text-gray-500 mb-4">
                    Informations de connexion
                </h2>

                <x-form.form method="PATCH" action="{{ route('admin.users.update.password', $user) }}">

                    <x-back.form.input 
                        name="password"
                        type="password"
                        label="Nouveau mot de passe"
                        placeholder="Nouveau mot de passe"
                        helper="L'utilisateur sera informé du changement de mot de passe"
                        required
                    />

                    <div class="flex justify-end mt-4 save-button">
                        <x-back.form.button>
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                            </svg>
                            Enregistrer les informations
                        </x-back.form.button>
                    </div>

                </x-form.form>
                
            </section>
        </div>



    <x-back.modal>
        <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez supprimer l'utilisateur et toutes les données qui y sont associées. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
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
                    Je supprime ce client
                </button>
            </form>
        </footer>
    </x-back.modal>
@endsection