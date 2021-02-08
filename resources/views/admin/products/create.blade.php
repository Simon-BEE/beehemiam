@extends('layouts.back')

@section('content')
    <div class="container grid px-6 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="#" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les vêtements</a>
            <span class="text-gray-500">/</span>
            <p>Ajouter un nouveau vêtement</p>
        </section>

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Ajouter un nouveau vêtement
        </h2>
    
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <x-form.form action="{{ route('admin.products.store') }}" method="POST">
                <x-back.form.input 
                    name="name"
                    type="text"
                    label="Nom du vêtement"
                    placeholder="Nom du vêtement"
                    value="{{ old('name') }}"
                    required
                />

                <div class="flex flex-col mt-4 ml-2 space-y-4">
                    <x-back.form.switch name="is_preorder">
                        Il s'agit d'une précommande
                    </x-back.form.switch>
        
                    <x-back.form.switch name="is_active">
                        Le vêtement sera mis en ligne directement
                    </x-back.form.switch>
                </div>

                <div class="variant my-6 p-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-900">
                    <x-back.form.input 
                        name="options[][name]"
                        type="text"
                        label="Nom du produit"
                        placeholder="Nom du produit"
                        value="{{ old('options.name') }}"
                        required
                    />
                    <x-back.form.input 
                        name="options[][sku]"
                        type="text"
                        label="Numéro d'identification du produit"
                        placeholder="Numéro d'identification du produit"
                        value="{{ old('options.sku') }}"
                        required
                    />
                    <x-back.form.input-icon
                        name="options[][price]"
                        type="text"
                        label="Prix du produit"
                        placeholder="Prix du produit"
                        value="{{ old('options.price') }}"
                        required
                    >
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.07,11L7,12L7.07,13H17.35L16.5,15H7.67C8.8,17.36 11.21,19 14,19C16.23,19 18.22,17.96 19.5,16.33V19.12C18,20.3 16.07,21 14,21C10.08,21 6.75,18.5 5.5,15H2L3,13H5.05L5,12L5.05,11H2L3,9H5.5C6.75,5.5 10.08,3 14,3C16.5,3 18.8,4.04 20.43,5.71L19.57,7.75C18.29,6.08 16.27,5 14,5C11.21,5 8.8,6.64 7.67,9H19.04L18.19,11H7.07Z" />
                        </svg>
                    </x-back.form.input-icon>

                    <x-back.form.wysiwyg name="description" label="{{ __('Description le produit') }}" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-back.form.button>
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
    <script>
        const editor = document.querySelector('.content-editor');
        if (editor) {
            const editorButtons = document.querySelectorAll('.editor-button');
            const showView = document.querySelector('.show-view');
            const htmlView = document.querySelector('.html-view');

            checkListElements();

            editorButtons.forEach((button) => {
                button.addEventListener('click', function(e) {
                    const action = this.getAttribute('data-action');

                    switch (action) {
                    case 'code':
                        execCodeAction(e.currentTarget, editor);
                        break;
                    case 'createLink':
                        execLinkAction();
                        break;
                    default:
                        execDefaultAction(action);
                        break;
                    }
                });
            });

            function execDefaultAction(action) {
                document.execCommand(action, false, null);
                checkListElements();
            }

            function execLinkAction() {
                let linkValue = prompt('URL (e.g. https://google.com/)');
                document.execCommand('createLink', false, linkValue);
                document.getSelection().focusNode.parentNode.classList.add("text-green-500", 'hover:underline');
            }

            function execCodeAction(button){
                if (htmlView.classList.contains('hidden')) {
                    htmlView.classList.replace('hidden', 'block');
                    showView.classList.replace('block', 'hidden');
                } else {
                    showView.classList.replace('hidden', 'block');
                    htmlView.classList.replace('block', 'hidden');
                }

                button.classList.toggle('bg-gray-200');
            }

            showView.addEventListener('input', () => {
                htmlView.innerHTML = showView.innerHTML;
            });

            function checkListElements() {
                showView.querySelectorAll('ul').forEach(list => {
                    if (!list.classList.contains('list-disc')) {
                        list.classList.add('p-2', 'bg-gray-100', 'my-2', 'list-disc', 'list-inside');
                    }
                });
            }
        }
    </script>
@endpush