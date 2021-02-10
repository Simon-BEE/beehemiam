@extends('layouts.back')

@section('meta-title')
    Editer une catégorie de vêtements
@endsection

@section('content')
    <div class="container grid px-6 mx-auto">

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

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Editer la catégorie : {{ $category->name }}
        </h2>
    
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
@endsection

@push('scripts')
    @include('includes.scripts.wysiwyg')
@endpush