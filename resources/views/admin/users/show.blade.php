@extends('layouts.back')

@section('meta-title')
    Voir le client : {{ $user->full_name }}
@endsection

@section('content')
    <div class="container grid px-6 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.users.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir tous les clients</a>
            <span class="text-gray-500">/</span>
            <p>Voir le client : {{ $user->full_name }}</p>
        </section>

        <div class="title my-6 flex flex-col md:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir le client : {{ $user->full_name }}
            </h2>
        </div>

        <section class="px-4 py-3 mb-20 bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi eaque doloribus nemo eligendi vero, voluptates error minima magnam nesciunt modi odio vel delectus facere fugiat eveniet impedit maxime, a, harum culpa! Quo iure dolore et, error alias fugit consequuntur tempore corporis nostrum voluptatibus nesciunt natus numquam reprehenderit! Quas in modi dolorem voluptatem aut minus iure ullam laborum assumenda nostrum voluptate expedita, omnis aliquam. Unde, dolorem dicta atque, voluptates odio saepe maiores temporibus quis dolorum quaerat amet veritatis recusandae voluptatum eaque velit magni asperiores rerum voluptatibus molestiae fugit illo omnis officiis. Repellendus alias unde tenetur praesentium molestias animi cumque mollitia voluptatibus?
        </section>
@endsection