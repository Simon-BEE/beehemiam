@extends('layouts.back')

@section('meta-title')
    Changer le statut de la commande n°{{ $order->id }}
@endsection

@section('content')
    <div class="container grid px-2 lg:px-6 pb-8 mx-auto">

        <section class="breadcrumb my-6 flex items-center flex-wrap space-x-2 text-gray-600 dark:text-gray-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
            </svg>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Tableau de bord</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-gray-700 dark:hover:text-gray-100">Voir toutes les commandes</a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('admin.orders.show', $order) }}" class="hover:text-gray-700 dark:hover:text-gray-100">Commande n°{{ $order->id }}</a>
            <span class="text-gray-500">/</span>
            <p>Changer le statut de la commande n°{{ $order->id }}</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <div class="flex items-center">
                <div class="">
                    <h2 class="font-bold text-2xl text-gray-700 dark:text-gray-300">Commande n°{{ $order->id }} <span class="font-normal">({{ $order->formatted_price }}€)</span></h2>
                    <p class="text-sm text-gray-500">Dernier changement de statut {{ $order->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-start space-y-8 lg:space-y-0 lg:space-x-8 lg:mb-8">
            <section class="px-4 py-8 w-full bg-white text-gray-700 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-300">
                <div class="flex flex-col">
                    <article class="mb-2 lg:mb-0">
                        <h2 class="font-bold text-lg">Commande n°{{ $order->id }}</h2>
                        <p class="text-gray-500 text-sm my-2">
                            Statut actuel
                            <span class="rounded-full text-white bg-{{ $order->status->color }}-500 py-1 px-2 ml-3">
                                {{ $order->status->name }}
                            </span>
                        </p>
                    </article>

                    <form action="#" method="POST" class="w-full md:w-1/2">
                        @csrf

                        <div class="w-full my-4">
                            <label for="status" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-white flex items-center justify-between">Choisir un nouveau statut de commande</label>
                            <div class="relative w-full border-none mt-2">
                                <select
                                    class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-white appearance-none border-none focus:outline-none focus:ring-2 focus:ring-gray-500 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="#" selected disabled>Choisissez un statut</option>
                                    @foreach ($status as $statut)
                                        <option value="{{ $statut->id }}">{{ $statut->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <x-back.form.button>
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z" />
                            </svg>
                            Confirmer le nouveau statut
                        </x-back.form.button>

                    </form>
                </div>
            </section>
        </div>

@endsection
