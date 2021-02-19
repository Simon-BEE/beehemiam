@extends('layouts.app')

@section('meta-title')
    Modifier mes paramètres
@endsection

@section('content')

<x-layouts.user>
    <section class="breadcrumb mb-6 flex items-center flex-wrap space-x-2 text-sm">
        <svg class="w-4 h-4" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
        </svg>
        <a href="{{ route('user.profile.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Mon compte</a>
        <span class="text-gray-500">/</span>
        <p>Modifier mes paramètres</p>
    </section>

    <section class="">
        <div class="title pb-3 border-b flex items-start justify-between">
            <div class="">
                <h2 class="font-bold text-2xl">Mes paramètres</h2>
                <p class="text-sm">Mettre à jour mes paramètres.</p>
            </div>
        </div>

        <article class="w-full md:w-1/2 mt-8">
            <p>Conformément aux nouvelles réglèmentations, issues de la <a href="https://www.cnil.fr/fr/comprendre-le-rgpd" class="font-bold underline">RGPD</a>, vous avez le droit d'accéder à toutes vos données qui sont stockés sur le site internet de Beehemiam. Pour cela, rien de plus simple : cliquez sur le bouton ci-dessous et dans quelques minutes vous recevrez un lien dans votre boîte mail, sur lequel vous pourrez télécharger ces données.</p>
            <x-form.form method="POST" action="{{ route('user.settings.personnal-data') }}" class="mt-4">
                <x-form.button>
                    <svg class="hidden md:block w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13,19H14A1,1 0 0,1 15,20H22V22H15A1,1 0 0,1 14,23H10A1,1 0 0,1 9,22H2V20H9A1,1 0 0,1 10,19H11V17H4A1,1 0 0,1 3,16V12A1,1 0 0,1 4,11H20A1,1 0 0,1 21,12V16A1,1 0 0,1 20,17H13V19M4,3H20A1,1 0 0,1 21,4V8A1,1 0 0,1 20,9H4A1,1 0 0,1 3,8V4A1,1 0 0,1 4,3M9,7H10V5H9V7M9,15H10V13H9V15M5,5V7H7V5H5M5,13V15H7V13H5Z" />
                    </svg>
                    Je souhaite accéder à mes données enregistrées sur Beehemiam.fr
                </x-form.button>
            </x-form.form>
        </article>

        <article class="w-full md:w-1/2 mt-8">
            <p>Vous pouvez supprimer votre compte de <a href="{{ url('/') }}" class="font-bold">Beehemiam.fr</a> si vous le désirez. Également dans le cadre des réglèmentations stipulées par la <a href="https://www.cnil.fr/fr/comprendre-le-rgpd" class="font-bold underline">RGPD</a>, vous avez le droit à l'effacement, soit le droit à l'oubli numérique. pour effectuer cette démarche, vous devez cliquer sur le bouton ci-dessous. Vous recevrez un e-mail afin de confirmer cette action.</p>
            <x-form.form method="POST" action="#" class="mt-4">
                <x-form.button class="bg-red-500 text-white hover:bg-red-600">
                    <svg class="hidden md:block w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                    </svg>
                    Je souhaite supprimer mon compte, et mes informations, de Beehemiam.fr
                </x-form.button>
            </x-form.form>
        </article>
    </section>
</x-layouts.user>

@endsection