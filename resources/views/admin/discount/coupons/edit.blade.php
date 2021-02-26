@extends('layouts.back')

@section('meta-title')
    Éditer le code promo : {{ $coupon->code }}
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.discount.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir toutes les promotions</a>
            <span class="text-gray-500">/</span>
            <p>Éditer le code promo : {{ $coupon->code }}</p>
        </section>

        <div class="my-6 flex flex-col md:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Éditer le code promo : {{ $coupon->code }}
            </h2>
            <div class="flex items-center space-x-2">
                @if ($coupon->is_expired)
                    <span class="px-3 py-1 rounded-full bg-red-500 text-white">Expirée</span>
                @else
                    <span class="px-3 py-1 rounded-full bg-green-500 text-white">En cours</span>
                @endif
                @if ($coupon->orders->isEmpty())
                <button
                    @click="openModal();"
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 bg-red-500 text-white hover:bg-red-600 rounded focus:outline-none focus:shadow-outline-gray"
                    aria-label="Delete">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    
        <div class="px-4 py-3 mb-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-form.form action="{{ route('admin.discount.coupons.update', $coupon) }}" method="PATCH">
                <x-back.form.input 
                    name="code"
                    type="text"
                    label="Code de réduction"
                    placeholder="Code de réduction"
                    value="{{ old('code') ?? $coupon->code }}"
                    required
                    helper="Le code promo, par exemple : SUMMER15"
                />

                <x-back.form.input-icon
                    name="amount"
                    type="text"
                    label="Pourcentage de la réduction"
                    placeholder="Pourcentage de la réduction"
                    value="{{ old('amount') ?? $coupon->amount }}"
                    required
                    >
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4,4A2,2 0 0,0 2,6V10C3.11,10 4,10.9 4,12A2,2 0 0,1 2,14V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V14A2,2 0 0,1 20,12C20,10.89 20.9,10 22,10V6C22,4.89 21.1,4 20,4H4M15.5,7L17,8.5L8.5,17L7,15.5L15.5,7M8.81,7.04C9.79,7.04 10.58,7.83 10.58,8.81A1.77,1.77 0 0,1 8.81,10.58C7.83,10.58 7.04,9.79 7.04,8.81A1.77,1.77 0 0,1 8.81,7.04M15.19,13.42C16.17,13.42 16.96,14.21 16.96,15.19A1.77,1.77 0 0,1 15.19,16.96C14.21,16.96 13.42,16.17 13.42,15.19A1.77,1.77 0 0,1 15.19,13.42Z" />
                        </svg>
                </x-back.form.input-icon>

                <x-back.form.input 
                    name="expired_at"
                    type="datetime-local"
                    label="Date d'expiration du code promo"
                    placeholder="Date d'expiration du code promo"
                    value="{{ old('expired_at') ?? $coupon->expired_at?->format('Y-m-d\TH:i') }}"
                    helper="Si vous voulez désactivez le code instantanément, mettez la date et l'heure actuelle"
                />

                <div class="flex justify-end mt-4 save-button">
                    <x-back.form.button>
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                        </svg>
                        Enregistrer les modifications
                    </x-back.form.button>
                </div>
            </x-form.form>
        </div>

    </div>

    <x-back.modal>
        <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Êtes-vous sûr de vouloir supprimer ce coupon de réduction ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez supprimer le coupon de réduction. Cela est possible car <strong>aucune commande</strong> n'a été passé avec ce code promo. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
            </p>
        </div>
        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-500 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Annuler
            </button>
            <form action="{{ route('admin.discount.coupons.destroy', $coupon) }}" method="POST" class="inline-flex items-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                    {{-- <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                    </svg> --}}
                    Je supprime ce coupon de réduction
                </button>
            </form>
        </footer>
    </x-back.modal>
@endsection