@extends('layouts.back')

@section('meta-title')
    Voir toutes les catégorie de vêtements
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de
                bord</a>
            <span class="text-gray-500">/</span>
            <p>Voir toutes les catégories</p>
        </section>

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

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir toutes les catégories
            </h2>
            <x-back.link-button href="{{ route('admin.categories.create') }}">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 12H14V10H16V12H18V14H16V16H14V14H12V12M22 8V18C22 19.11 21.11 20 20 20H4C2.89 20 2 19.11 2 18V6C2 4.89 2.89 4 4 4H10L12 6H20C21.11 6 22 6.89 22 8M20 8H4V18H20V8Z" />
                </svg>
                Ajouter une nouvelle catégorie
            </x-back.link-button>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-5">Nom</th>
                            <th class="px-4 py-5">Nombre de vêtements</th>
                            <th class="px-4 py-5">Créée le</th>
                            <th class="px-4 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($categories as $category)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <p class="font-semibold">{{ $category->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                   {{ $category->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-purple-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <x-back.form.button 
                                            class="text-red-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white"
                                            @click="changeModalButtonLink(`{{ route('admin.categories.destroy', $category) }}`);openModal();" 
                                            aria-label="Delete"
                                        >
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </x-back.form.button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">
                                    Aucune catégorie n'a été enregistée. <a href="{{ route('admin.categories.create') }}"
                                        class="text-indigo-500 hover:underline">Créez en une !</a>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $categories->links() }}
            </div>
        </div>

    </div>
@endsection
