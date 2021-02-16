@extends('layouts.back')

@section('meta-title')
    Ajouter un nouveau vêtement
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
            <p>Ajouter un nouveau vêtement</p>
        </section>

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ajouter un nouveau vêtement
        </h2>
    
        <div class="px-4 py-3 mb-20 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-form.form action="{{ route('admin.products.store') }}" method="POST" id="createProductForm" files>
                <x-back.form.input 
                    name="name"
                    type="text"
                    label="Nom du vêtement"
                    placeholder="Nom du vêtement"
                    value="{{ old('name') }}"
                    required
                />

                <div class="mb-8">
                    <label for="all_categories" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400">
                        À quelles catégories le vêtements sera attaché ? (une ou plusieurs)
                    </label>
                    <div class="flex items-center flex-wrap space-x-4 -mt-3">
                        @foreach ($categories as $category)
                            <x-back.form.checkbox name="categories[]" value="{{ $category->id }}">
                                {{ $category->name }}
                            </x-back.form.checkbox>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col mt-4 ml-2 space-y-4">
                    <x-back.form.switch name="is_preorder" onchange="addQuantityField(this)">
                        Il s'agit d'une précommande
                    </x-back.form.switch>
        
                    <x-back.form.switch name="is_active">
                        Le vêtement sera mis en ligne directement
                    </x-back.form.switch>
                </div>

                <section class="variant relative mt-12 mb-16 px-4 pt-5 pb-16 bg-gray-100 rounded-lg shadow-md dark:bg-gray-900">
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

                    <div class="absolute bottom-0 left-1/2 -ml-20 -mb-5">
                        <x-back.form.button class="flex-col add-new-option" type="button">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M13,7H11V11H7V13H11V17H13V13H17V11H13V7Z" />
                            </svg>
                            Ajouter une autre option
                        </x-back.form.button>
                    </div>
                </section>

                <div class="flex justify-end mt-4 save-button">
                    <x-back.form.button onclick="checkForm()" type="button">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                        </svg>
                        Enregistrer le vêtement
                    </x-back.form.button>
                </div>
            </x-form.form>
        </div>

    </div>
@endsection

@push('scripts')
    @include('includes.scripts.wysiwyg')

    <script>
        function checkForm() {
            document.querySelectorAll('.show-view').forEach(showView => pushContentInTextarea(showView));

            document.getElementById('createProductForm').submit()
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

        // New variant product click button
        document.querySelectorAll('.add-new-option').forEach(button => button.addEventListener('click', (e) => addNewOption(e.currentTarget)));

        function addNewOption(button) {
            let clone = button.parentNode.parentNode.cloneNode(true);
            clone.querySelector('.add-new-option').addEventListener('click', (e) => addNewOption(e.currentTarget));
            cleanCloneSection(clone)
            document.querySelector('form').insertBefore(clone, document.querySelector('.save-button'));
            button.remove();
        }

        function cleanCloneSection(div) {
            div.querySelectorAll('[name]').forEach(element => {
                let number = parseInt(element.name.slice(8, 9)) + 1;
                let newName = element.name.substring(0, 8) + number + element.name.substring(9);
                element.name = newName;
                element.id = newName;
                if (element.type !== 'checkbox') {
                    element.value = '';
                }
            })

            div.querySelector('.previews').innerHTML = '';

            div.querySelector('input[type="file"]').addEventListener('change', function() {
                readURL(this);
            });
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
    </script>
@endpush