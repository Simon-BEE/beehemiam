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
            @if ($message->reply)
            <span class="rounded-full inline-flex items-center bg-green-500 text-white px-2 py-1">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10,17L5,12L6.41,10.58L10,14.17L17.59,6.58L19,8M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z" />
                </svg>
                Répondu
            </span>
            @elseif ($message->read_at)
            <span class="rounded-full inline-flex items-center bg-blue-500 text-white px-2 py-1">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20,12V16C20,17.11 19.11,18 18,18H13.9L10.2,21.71C10,21.89 9.76,22 9.5,22H9A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V6C2,4.89 2.9,4 4,4H9.5C8.95,4.67 8.5,5.42 8.14,6.25L7.85,7L8.14,7.75C9.43,10.94 12.5,13 16,13C17.44,13 18.8,12.63 20,12M16,6C16.56,6 17,6.44 17,7C17,7.56 16.56,8 16,8C15.44,8 15,7.56 15,7C15,6.44 15.44,6 16,6M16,3C18.73,3 21.06,4.66 22,7C21.06,9.34 18.73,11 16,11C13.27,11 10.94,9.34 10,7C10.94,4.66 13.27,3 16,3M16,4.5A2.5,2.5 0 0,0 13.5,7A2.5,2.5 0 0,0 16,9.5A2.5,2.5 0 0,0 18.5,7A2.5,2.5 0 0,0 16,4.5" />
                </svg>
                Lu
            </span>
            @else
            <span class="rounded-full inline-flex items-center bg-red-500 text-white px-2 py-1">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19,3H16.3H7.7H5A2,2 0 0,0 3,5V7.7V16.4V19A2,2 0 0,0 5,21H7.7H16.4H19A2,2 0 0,0 21,19V16.3V7.7V5A2,2 0 0,0 19,3M15.6,17L12,13.4L8.4,17L7,15.6L10.6,12L7,8.4L8.4,7L12,10.6L15.6,7L17,8.4L13.4,12L17,15.6L15.6,17Z" />
                </svg>
                Non-lu
            </span>
            @endif
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

                    <p class="my-4 p-4 shadow rounded bg-gray-100 dark:bg-gray-600 dark:text-gray-900">
                        {!! nl2br($message->content) !!}
                    </p>
                </article>
            </section>

            <section class="flex flex-col w-full md:w-1/2 px-4 py-3 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">

                @if ($message->reply)
                    <h3 class="text-xl font-bold uppercase">Votre réponse</h3>

                    <p>Réponse envoyée le {{ $message->reply->created_at->format('d/m/Y à H:i') }}</p>

                    <p class="my-4 p-4 shadow rounded bg-gray-100 dark:bg-gray-600 dark:text-gray-900">
                        {!! nl2br($message->reply->content) !!}
                    </p>
                @else
                    <h3 class="text-xl font-bold uppercase">Répondre au message</h3>

                    <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                        @csrf

                        <x-back.form.textarea
                            name="content"
                            label="Votre réponse au message"
                            placeholder="Votre réponse au message"
                            value="{{ old('content') }}"
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
                @endif

            </section>
        </section>

    </div>
@endsection
