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
            <x-form.form action="{{ route('admin.categories.update', $category) }}" method="POST" files>
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
    <script>
        const editor = document.querySelector('.content-editor');
        if (editor) {
            const editorButtons = document.querySelectorAll('.editor-button');
            const showViews = document.querySelectorAll('.show-view');
            // const htmlView = document.querySelector('.html-view');

            checkListElements();

            editorButtons.forEach((button) => {
                button.addEventListener('click', function(e) {
                    const action = this.getAttribute('data-action');

                    switch (action) {
                    case 'code':
                        execCodeAction(e.currentTarget, e.currentTarget.parentNode.parentNode.parentNode.parentNode);
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

            function execCodeAction(button, editor){
                
                let htmlView = editor.querySelector('.html-view');
                let showView = editor.querySelector('.show-view');
                if (htmlView.classList.contains('hidden')) {
                    htmlView.classList.replace('hidden', 'block');
                    showView.classList.replace('block', 'hidden');
                } else {
                    showView.classList.replace('hidden', 'block');
                    htmlView.classList.replace('block', 'hidden');
                }

                button.classList.toggle('bg-gray-200');
            }

            showViews.forEach(showView => showView.addEventListener('input', () => {
                let htmlView = showView.parentNode.querySelector('.html-view');
                htmlView.innerHTML = showView.innerHTML;
            }));

            function checkListElements() {
                showViews.forEach(showView => showView.querySelectorAll('ul').forEach(list => {
                    if (!list.classList.contains('list-disc')) {
                        list.classList.add('p-2', 'bg-gray-100', 'my-2', 'list-disc', 'list-inside', 'dark:bg-gray-900', 'rounded');
                    }
                }));
            }
        }
    </script>
@endpush