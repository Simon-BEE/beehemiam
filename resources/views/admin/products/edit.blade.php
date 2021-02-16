@extends('layouts.back')

@section('meta-title')
    Modifier le vêtement : {{ $product->name }}
@endsection

@section('content')
    <div class="container grid px-2 md:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les vêtements</a>
            <span class="text-gray-500">/</span>
            <p>Modifier le vêtement : {{ $product->name }}</p>
        </section>

        <div class="title flex flex-col md:flex-row items-center justify-between">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Modifier le vêtement : {{ $product->name }}
            </h2>
            <button
                @click="changeModalButtonLink(`{{ route('admin.products.destroy', $product) }}`);openModal();"
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
            <x-form.form action="{{ route('admin.products.update', $product) }}" method="PATCH" id="editProductForm" files>
                <x-back.form.input 
                    name="name"
                    type="text"
                    label="Nom du vêtement"
                    placeholder="Nom du vêtement"
                    value="{{ $product->name }}"
                    required
                />

                <div class="mb-8">
                    <label for="all_categories" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400">
                        À quelles catégories le vêtements est attaché ? (une ou plusieurs)
                    </label>
                    <div class="flex items-center flex-wrap space-x-4 -mt-3">
                        @foreach ($categories as $category)
                            <x-back.form.checkbox 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                isCheck="{{ $product->categories->contains('id', $category->id) }}"
                            >
                                {{ $category->name }}
                            </x-back.form.checkbox>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col mt-4 ml-2 space-y-4">
                    @if ($product->is_preorder || !$product->is_active)
                        <x-back.form.switch 
                            name="is_preorder" 
                            isCheck="{{ $product->is_preorder }}"
                            onchange="alertProductOptions(this)"
                        >
                            Il s'agit d'une précommande
                        </x-back.form.switch>
                    @endif
        
                    @if ($product->productOptions->isNotEmpty())
                        <x-back.form.switch 
                            name="is_active"
                            isCheck="{{ $product->is_active }}"
                        >
                            Le vêtement sera mis en ligne directement
                        </x-back.form.switch>
                    @endif
                </div>

                <section class="variant hidden relative mt-12 mb-16 px-4 pt-5 pb-16 bg-gray-100 rounded-lg shadow-md dark:bg-gray-900">
                    <x-back.form.input 
                        name="options[1][name]"
                        type="text"
                        label="Nom du produit"
                        placeholder="Nom du produit"
                        value="{{ old('options.1.name') }}"
                        required
                    />
                    <x-back.form.input 
                        name="options[1][sku]"
                        type="text"
                        label="Numéro d'identification du produit"
                        placeholder="Numéro d'identification du produit"
                        value="{{ old('options.1.sku') }}"
                        required
                    />
                    <x-back.form.input-icon
                        name="options[1][price]"
                        type="text"
                        label="Prix du produit"
                        placeholder="Prix du produit"
                        value="{{ old('options.1.price') }}"
                        required
                    >
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.07,11L7,12L7.07,13H17.35L16.5,15H7.67C8.8,17.36 11.21,19 14,19C16.23,19 18.22,17.96 19.5,16.33V19.12C18,20.3 16.07,21 14,21C10.08,21 6.75,18.5 5.5,15H2L3,13H5.05L5,12L5.05,11H2L3,9H5.5C6.75,5.5 10.08,3 14,3C16.5,3 18.8,4.04 20.43,5.71L19.57,7.75C18.29,6.08 16.27,5 14,5C11.21,5 8.8,6.64 7.67,9H19.04L18.19,11H7.07Z" />
                        </svg>
                    </x-back.form.input-icon>

                    <div class="mb-8 block sizes-quantities">
                        <label for="all_categories" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400">
                            Sélectionnez les tailles disponibles et indiquez leurs quantités respective
                        </label>
                        <div class="flex flex-col md:flex-row items-center flex-wrap">
                            @foreach ($sizes as $size)
                                <div class="w-full md:w-1/2">
                                    <div class="w-full md:w-1/2 flex items-baseline justify-between space-x-4">
                                        <x-back.form.checkbox name="options[1][sizes][{{ $loop->index }}][id]" value="{{ $size->id }}">
                                            {{ $size->name }}
                                        </x-back.form.checkbox>
                                        <x-back.form.input classDiv=""
                                            name="options[1][sizes][{{ $loop->index }}][quantity]"
                                            id="options[1][sizes][quantity][{{ $size->id }}]"
                                            type="text"
                                            placeholder="Quantité"
                                            required
                                        />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <x-back.form.wysiwyg name="options[1][description]" label="{{ __('Description du produit') }}" />

                    <div class="flex flex-col md:flex-row justify-between md:space-x-32 mt-12">
                        <x-back.form.file-input 
                            name="options[1][images][]"
                            type="file"
                            classDiv="flex flex-wrap mb-4 w-full"
                            label="Ajouter des photos au produit"
                            value="{{ old('options.1.description') }}"
                            multiple
                        />
                    </div>

                    {{-- <div class="absolute bottom-0 left-1/2 -ml-20 -mb-5">
                    </div> --}}
                </section>

                <div class="flex justify-end mt-4 save-button">
                    <x-back.form.button class="mr-2 add-new-option" type="button">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M13,7H11V11H7V13H11V17H13V13H17V11H13V7Z" />
                        </svg>
                        Ajouter une option
                    </x-back.form.button>
                    <x-back.form.button onclick="checkForm()" type="button">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                        </svg>
                        Enregistrer les modifications
                    </x-back.form.button>
                </div>
            </x-form.form>
        </div>

        <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Modifier les options
        </h2>
    
        <div class="px-4 pb-3 pt-6 mb-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
            @forelse ($product->productOptions as $option)
                <a href="{{ route('admin.products.options.edit', [$product, $option]) }}" class="p-3 mb-3 bg-gray-100 rounded-lg shadow-md dark:bg-gray-900 flex flex-col md:flex-row items-center justify-between cursor-pointer transition-all duration-500 ring-4 ring-purple-500 ring-opacity-0 hover:ring-opacity-10">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $option->thumb_image->path }}" alt="{{ $option->name }}" class="w-20 h-20 object-cover rounded shadow">
                        <p class="text-gray-600 dark:text-gray-400 text-xl font-semibold">{{ $option->name }}</p>
                    </div>
                    <div class="">
                        <x-back.form.button class="mr-2" type="button">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                            Éditer
                        </x-back.form.button>
                    </div>
                </a>
            @empty
                <p class="text-gray-600 dark:text-gray-100">Le vêtement n'a aucune variante. Il ne pourra pas être en ligne.</p>
            @endforelse
        </div>

    </div>

    <x-back.modal>
        <div class="mt-4 mb-6">
            <!-- Modal title -->
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Êtes-vous sûr de vouloir supprimer ce produit ?
            </p>
            <!-- Modal description -->
            <p class="text-sm text-gray-700 dark:text-gray-400">
                En confirmant cette action, vous allez supprimer le produit et toutes les options qui y sont associées. Vous pouvez annuler cette action en cliquant sur le bouton <strong>annuler</strong> ci-dessous.
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
                    Je supprime ce produit et ses options
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
            let firstFieldValue = document.querySelector('input[name="options[1][name]"]').value;

            // Remove variant forms (because send null value in PHP)
            if (firstFieldValue === null || firstFieldValue === '') {
                document.querySelectorAll('.variant').forEach(div => div.remove());
            }

            document.getElementById('editProductForm').submit()
        }

        // New variant product click button
        document.querySelectorAll('.add-new-option').forEach(button => button.addEventListener('click', (e) => addNewOption(e.currentTarget)));

        function addNewOption(button) {
            document.querySelector('.variant').classList.replace('hidden', 'block');
            button.remove();
        }

        function addQuantityField(input) {
            if (input.checked) {
                document.querySelectorAll('.sizes-quantities').forEach(sizeQtyDiv => sizeQtyDiv.classList.replace('block', 'hidden'));
                
                document.querySelectorAll('.variant').forEach(optionDiv => {
                    let baseClone = optionDiv.querySelector('input');
                    let clone = baseClone.parentNode.cloneNode(true);
                    let quantityInput = clone.querySelector('input');
                    let quantityLabel = clone.querySelector('label');
                    let nameInput = quantityInput.name.replace('name', 'quantity');

                    clone.classList.add('preorderQuantity');
                    quantityInput.name = nameInput;
                    quantityInput.id = nameInput;
                    quantityInput.placeholder = 'Quantité de vêtements disponible en précommande';
                    quantityInput.value = '';
                    quantityLabel.htmlFor = nameInput;
                    quantityLabel.innerHTML = "Quantité de vêtements disponible en précommande";

                    optionDiv.appendChild(clone)
                });
            }else{
                document.querySelectorAll('.preorderQuantity').forEach(quantityDiv => {
                    document.querySelectorAll('.sizes-quantities').forEach(sizeQtyDiv => sizeQtyDiv.classList.replace('hidden', 'block'));
                    quantityDiv.remove()
                });
            }
        }

        function alertProductOptions(input){
            if (document.querySelector('.alert-banner')) {
                document.querySelector('.alert-banner').remove();
            }
            addQuantityField(input);

            if (!input.checked) {
                return;
            }
                addNewOption(document.querySelector('.add-new-option'))

            let div = document.createElement('div');
            div.className = "alert-banner bg-red-500 bg-opacity-50 text-gray-100 w-full h-20 fixed bottom-0 left-0 z-50 flex justify-center items-center text-center text-xl";
            div.innerHTML = "Vous devez définir au moins une option et sa quantité pour mettre en ligne la précommande.";

            let span = document.createElement('span');
            span.className = "absolute right-2 top-5 text-white cursor-pointer p-3 rounded hover:bg-red-500";
            span.innerHTML = "&times;";
            span.addEventListener('click', () => div.remove());

            div.append(span);
            document.body.append(div);
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
    </script>
@endpush