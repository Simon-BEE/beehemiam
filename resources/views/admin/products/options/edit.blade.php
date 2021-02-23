@extends('layouts.back')

@section('meta-title')
Modifier l'option : {{ $productOption->name }}
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les vêtements</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.products.edit', $product) }}" class="hover:text-gray-700 dark:hover:text-gray-100">Modifier le vêtement : {{ $product->name }}</a>
            <span class="text-gray-500">/</span>
            <p>Modifier l'option : {{ $productOption->name }}</p>
        </section>

        <div class="title flex flex-col lg:flex-row items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Modifier l'option : {{ $productOption->name }}
            </h2>
            <button
                @click="changeModalButtonLink(`{{ route('admin.products.options.destroy', [$product, $productOption]) }}`);openModal();"
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
            <x-form.form action="{{ route('admin.products.options.update', [$product, $productOption]) }}" method="PATCH" id="editProductForm" files>
                <x-back.form.input 
                    name="name"
                    type="text"
                    label="Nom du produit"
                    placeholder="Nom du produit"
                    value="{{ $productOption->name }}"
                    required
                />
                <x-back.form.input 
                    name="sku"
                    type="text"
                    label="Numéro d'identification du produit"
                    placeholder="Numéro d'identification du produit"
                    value="{{ $productOption->sku }}"
                    required
                />
                <x-back.form.input-icon
                    name="price"
                    type="text"
                    label="Prix du produit"
                    placeholder="Prix du produit"
                    value="{{ $productOption->formatted_price }}"
                    required
                >
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M7.07,11L7,12L7.07,13H17.35L16.5,15H7.67C8.8,17.36 11.21,19 14,19C16.23,19 18.22,17.96 19.5,16.33V19.12C18,20.3 16.07,21 14,21C10.08,21 6.75,18.5 5.5,15H2L3,13H5.05L5,12L5.05,11H2L3,9H5.5C6.75,5.5 10.08,3 14,3C16.5,3 18.8,4.04 20.43,5.71L19.57,7.75C18.29,6.08 16.27,5 14,5C11.21,5 8.8,6.64 7.67,9H19.04L18.19,11H7.07Z" />
                    </svg>
                </x-back.form.input-icon>

                @if ($product->is_preorder)
                    <x-back.form.input 
                        name="quantity"
                        type="text"
                        label="Quantité de vêtements disponible en précommande"
                        placeholder="Quantité de vêtements disponible en précommande"
                        value="{{ $productOption->preOrderStock ? $productOption->preOrderStock->quantity : null }}"
                        required
                    />
                @else
                    <div class="mb-8 block sizes-quantities">
                        <label for="all_categories" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400">
                            Sélectionnez les tailles disponibles et indiquez leurs quantités respective
                        </label>
                        <div class="flex flex-col lg:flex-row items-center flex-wrap">
                            @foreach ($sizes as $size)
                                <div class="w-full lg:w-1/2">
                                    <div class="w-full lg:w-1/2 flex items-baseline justify-between space-x-4">
                                        <x-back.form.checkbox 
                                            name="sizes[{{ $loop->index }}][id]" 
                                            value="{{ $size->id }}" 
                                            isCheck="{{ $productOption->hasSize($size->id) }}"
                                        >
                                            {{ $size->name }}
                                        </x-back.form.checkbox>
                                        <x-back.form.input classDiv=""
                                            name="sizes[{{ $loop->index }}][quantity]"
                                            id="sizes[{{ $loop->index }}][quantity]"
                                            type="text"
                                            value="{{ $productOption->hasSize($size->id) ? $productOption->getSizeQuantity($size->id) : null }}"
                                            placeholder="Quantité"
                                            required
                                        />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <x-back.form.wysiwyg name="description" label="{{ __('Description du produit') }}" />

                <div class="previews my-3 flex flex-wrap justify-center items-center lg:space-x-4">
                    @foreach ($productOption->imagesWithoutThumb as $image)
                        <div class="relative transition-opacity duration-700">
                            <img src="{{ $image->path }}" alt="{{ $productOption->name }} - {{ $image->id }}" class="w-64 h-48 rounded shadow object-cover" data-img="{{ $image->id }}">
                            <button type="button" class="px-2 py-1 rounded bg-black bg-opacity-50 text-white hover:bg-opacity-75 absolute top-1 right-1 remove-image">
                                <svg class="w-4 h-4" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M9,8H11V17H9V8M13,8H15V17H13V8Z" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-col lg:flex-row justify-between lg:space-x-32 mt-12">
                    <x-back.form.file-input 
                        name="images[]"
                        type="file"
                        classDiv="flex flex-wrap mb-4 w-full"
                        label="Ajouter des photos au produit"
                        value="{{ $productOption->description }}"
                        multiple
                    />
                </div>

                <div class="flex justify-end mt-4 save-button">
                    <x-back.form.button onclick="checkForm()" type="button">
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
                Êtes-vous sûr de vouloir supprimer cette option ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez supprimer l'option du vêtement {{ $product->name }}. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
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
                    Je supprime cette option
                </button>
            </form>
        </footer>
    </x-back.modal>
@endsection

@push('scripts')
    @include('includes.scripts.wysiwyg')

    <script>
        function checkForm() {
            document.querySelectorAll('.show-view').forEach(showView => pushContentInTextarea(showView));

            document.getElementById('editProductForm').submit()
        }

        function readURL(input) {
            const previewDiv = input.parentNode.parentNode.querySelector('.previews');
            if (input.files && input.files.length) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        let image = document.createElement('img');
                        image.src    = e.target.result;
                        image.classList.add('w-64', 'h-48', 'rounded', 'shadow', 'object-cover');
                        image.addEventListener('click', (e) => {
                            e.currentTarget.remove();
                            previewDiv.innerHTML = '';
                            input.value = '';
                        });
                        previewDiv.append(image);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        document.querySelectorAll('input[type="file"]').forEach(input => input.addEventListener('change', function() {
            readURL(this);
        }));

        document.querySelectorAll('.remove-image').forEach(image => image.addEventListener('click', function() {
            removeImage(this);
        }));

        function removeImage(button) {
            let parent = button.parentNode;
            let img = parent.querySelector('img');

            axios.post(`/yW4YQwtUCqbpswckCXLoiYmxg7d2GG/produits/options/images/${img.getAttribute('data-img')}/delete`, {_method: 'DELETE'})
                .then(() => {
                    parent.classList.add('opacity-0');

                    setTimeout(() => {
                        parent.remove();
                    }, 1000);
                })
                .catch(() => alert('Une erreur est survenue'));

        }
    </script>
@endpush