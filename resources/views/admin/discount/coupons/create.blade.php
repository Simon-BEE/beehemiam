@extends('layouts.back')

@section('meta-title')
    Ajouter un nouveau code promo
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
            <p>Ajouter un nouveau code promo</p>
        </section>

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ajouter un nouveau code promo
        </h2>
    
        <div class="px-4 py-3 mb-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-form.form action="{{ route('admin.discount.coupons.store') }}" method="POST">
                <x-back.form.input 
                    name="code"
                    type="text"
                    label="Code de réduction"
                    placeholder="Code de réduction"
                    value="{{ old('code') }}"
                    required
                    helper="Le code promo, par exemple : SUMMER15"
                />

                <x-back.form.input-icon
                    name="amount"
                    type="text"
                    label="Pourcentage de la réduction"
                    placeholder="Pourcentage de la réduction"
                    value="{{ old('amount') }}"
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
                    value="{{ old('expired_at') }}"
                />

                <div class="flex justify-end mt-4 save-button">
                    <x-back.form.button>
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                        </svg>
                        Enregistrer le code promo
                    </x-back.form.button>
                </div>
            </x-form.form>
        </div>

    </div>
@endsection