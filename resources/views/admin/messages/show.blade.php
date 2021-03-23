@extends('layouts.back')

@section('meta-title')
    Message n°{{ $message->id }} - {{ $message->object }}
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
            <a href="{{ route('admin.messages.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les messages</a>
            <span class="text-gray-500">/</span>
            <p>Message n°{{ $message->id }}</p> - {{ $message->object }}
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Message n°{{ $message->id }} - {{ $message->object }}
            </h2>
        </div>

        <section class="flex flex-col md:flex-row items-start justify-between md:space-x-6">
            <section class="px-4 py-3 w-full md:w-1/2 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col lg:flex-row justify-between items-start">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">{{ $message->object }}</h2>
                        <p class="text-gray-500 text-sm">Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</p>
                        <p class="text-gray-500 text-sm">Lu {{ $message->read_at ? 'le ' . $message->read_at->format('d/m/Y à H:i') : 'à l\'instant' }}</p>
                    </article>
                </div>

                <article class="my-4 text-gray-500">
                    <p>Envoyé depuis l'adresse email : <strong>{{ $message->email }}</strong></p>

                    <p class="my-4 p-4 shadow rounded bg-gray-100 dark:bg-gray-700 dark:text-gray-900">
                        {!! nl2br($message->content) !!}
                    </p>
                </article>
            </section>

            <h1 class="text-9xl">TODO</h1>

            <section class="flex flex-col w-full md:w-1/2 px-4 py-3 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <h3 class="text-xl font-bold uppercase">Répondre au message</h3>

                <form action="#" method="POST">
                    @csrf

                    <x-back.form.textarea
                        name="content"
                        label="Votre réponse au message"
                        placeholder="Votre réponse au message"
                        value="{{ old('content') ?? request()->get('content') }}"
                        required
                    />
                    <div class="flex justify-end">
                        <x-back.form.button class="bg-teal-500 text-gray-100 hover:bg-teal-600">
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10,9V5L3,12L10,19V14.9C15,14.9 18.5,16.5 21,20C20,15 17,10 10,9Z" />
                            </svg>
                            <span class="text-lg font-bold">Répondre au message</span>
                        </x-back.form.button>
                    </div>
                </form>
            </section>
        </section>

    </div>
@endsection
