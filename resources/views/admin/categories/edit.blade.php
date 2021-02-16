@extends('layouts.back')

@section('meta-title')
    Editer une catégorie de vêtements
@endsection

@section('content')
    <div class="container grid px-2 md:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.categories.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir toutes les catégories</a>
            <span class="text-gray-500">/</span>
            <p>Editer la catégorie : {{ $category->name }}</p>
        </section>

        <div class="title flex flex-col md:flex-row items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Editer la catégorie : {{ $category->name }}
            </h2>
            <button
                @click="changeModalButtonLink(`{{ route('admin.categories.destroy', $category) }}`);openModal();"
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 bg-red-500 text-white hover:bg-red-600 rounded focus:outline-none focus:shadow-outline-gray"
                aria-label="Delete">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    
        <div class="px-4 py-3 mb-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-form.form action="{{ route('admin.categories.update', $category) }}" method="PATCH" files>
                <x-back.form.input 
                    name="name"
                    type="text"
                    label="Nom de la catégorie"
                    placeholder="Nom de la catégorie"
                    value="{{ $category->name }}"
                    required
                />

                <x-back.form.wysiwyg 
                    name="description" 
                    label="{{ __('Description de la catégorie') }}" 
                    value="{{ $category->description }}"
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
                Êtes-vous sûr de vouloir supprimer cette catégorie ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez supprimer la catégorie et ainsi rendre invisible les produits qui y sont associés. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
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
                    Je supprime cette catégorie
                </button>
            </form>
        </footer>
    </x-back.modal>
@endsection

@push('scripts')
    @include('includes.scripts.wysiwyg')
@endpush