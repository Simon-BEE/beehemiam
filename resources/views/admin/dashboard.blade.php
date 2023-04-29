@extends('layouts.back')

@section('meta-title')
    Tableau de bord
@endsection

@section('content')
<div class="container grid px-2 lg:px-6 pb-8 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
    </h2>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 lg:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total clients
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $clients_count }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Revenus
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $total_incomes }}€
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Commandes
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $orders_count }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill="currentColor" d="M20 6H2V2H20V6M16.5 12H15V17L18.61 19.16L19.36 17.94L16.5 16.25V12M23 16C23 19.87 19.87 23 16 23C13.62 23 11.53 21.81 10.26 20H3V7H19V9.68C21.36 10.81 23 13.21 23 16M8 12H10.26C10.83 11.19 11.56 10.5 12.41 10H8.5C8.22 10 8 10.22 8 10.5V12M21 16C21 13.24 18.76 11 16 11S11 13.24 11 16 13.24 21 16 21 21 18.76 21 16Z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Précommandes
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $preorders_count }}
                </p>
            </div>
        </div>
    </div>

    <section class="flex flex-col lg:flex-row lg:space-x-6 mb-2">
        <section class="mb-6 w-full lg:w-1/3 p-4 text-gray-700 dark:text-gray-200 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h2 class="text-sm uppercase text-gray-500 font-bold mb-3">Articles en faible stock</h2>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-5">Nom</th>
                        <th class="px-4 py-5">En stock</th>
                        <th class="px-4 py-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @forelse ($stock_products as $product)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <p class="font-semibold">{{ $product->name }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold">
                                    <span class="rounded-full p-2 font-bold whitespace-nowrap {{ $product->total_stock > 5 ? 'bg-gray-100 text-gray-700' : 'bg-red-500 text-white' }}">
                                        {{ $product->total_stock }}
                                    </span>
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Aucun vêtement n'a un stock inférieur à {{ config('beehemiam.stocks.min') }}.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </section>

        <section class="mb-6 w-full lg:w-2/3 p-4 text-gray-700 dark:text-gray-200 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h2 class="text-sm uppercase text-gray-500 font-bold mb-3">Dernières commandes</h2>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-5">N° de commande</th>
                        <th class="px-4 py-5">Montant total</th>
                        <th class="px-4 py-5">Nombre d'articles</th>
                        <th class="px-4 py-5">Statut</th>
                        <th class="px-4 py-5">Passée le</th>
                        <th class="px-4 py-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @forelse ($latest_orders as $order)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <p class="font-semibold">#{{ $order->id }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm ml-8">
                                <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                    {{ $order->formatted_price }}€
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm ml-16">
                                <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                    {{ $order->order_items_count }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm ml-8">
                                <span class="rounded-full text-white bg-{{ $order->status->color }}-500 p-2">
                                    {{ $order->status->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                               {{ $order->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Show">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Aucune commande n'a été passée pour le moment.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            @if ($latest_orders->isNotEmpty() && $latest_orders->count() > 4)
                <p class="text-right mt-auto">
                    <a href="{{ route('admin.orders.index') }}" class="text-xs uppercase text-gray-500 hover:underline">Tout voir...</a>
                </p>
            @endif
        </section>
    </section>

    <section class="flex flex-col lg:flex-row lg:space-x-6 mb-2">
        <section class="mb-6 w-full lg:w-1/2 p-4 text-gray-700 dark:text-gray-200 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h2 class="text-sm uppercase text-gray-500 font-bold mb-3">Dernières inscriptions</h2>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-5">Nom</th>
                        <th class="px-4 py-5">Adresse email</th>
                        <th class="px-4 py-5">Enregistré le</th>
                        <th class="px-4 py-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @forelse ($latest_users as $user)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <p class="font-semibold">{{ $user->full_name }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm ml-8">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                               {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('admin.users.orders', $user) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Show orders"
                                        title="Show orders"
                                    >
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Show customer"
                                        title="Show customer"
                                    >
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M10,13C9.65,13.59 9.36,14.24 9.19,14.93C6.5,15.16 3.9,16.42 3.9,17V18.1H9.2C9.37,18.78 9.65,19.42 10,20H2V17C2,14.34 7.33,13 10,13M10,4A4,4 0 0,1 14,8C14,8.91 13.69,9.75 13.18,10.43C12.32,10.75 11.55,11.26 10.91,11.9L10,12A4,4 0 0,1 6,8A4,4 0 0,1 10,4M10,5.9A2.1,2.1 0 0,0 7.9,8A2.1,2.1 0 0,0 10,10.1A2.1,2.1 0 0,0 12.1,8A2.1,2.1 0 0,0 10,5.9M15.5,12C18,12 20,14 20,16.5C20,17.38 19.75,18.21 19.31,18.9L22.39,22L21,23.39L17.88,20.32C17.19,20.75 16.37,21 15.5,21C13,21 11,19 11,16.5C11,14 13,12 15.5,12M15.5,14A2.5,2.5 0 0,0 13,16.5A2.5,2.5 0 0,0 15.5,19A2.5,2.5 0 0,0 18,16.5A2.5,2.5 0 0,0 15.5,14Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit"
                                        title="Edit"
                                    >
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Personne ne s'est encore inscrit sur le site.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            @if ($latest_users->isNotEmpty() && $latest_users->count() > 4)
                <p class="text-right mt-auto">
                    <a href="{{ route('admin.users.index') }}" class="text-xs uppercase text-gray-500 hover:underline">Tout voir...</a>
                </p>
            @endif
        </section>

        <section class="mb-6 w-full lg:w-1/2 p-4 text-gray-700 dark:text-gray-200 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h2 class="text-sm uppercase text-gray-500 font-bold mb-3">Précommandes en cours</h2>

            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-5">N° de commande</th>
                        <th class="px-4 py-5">Montant total</th>
                        <th class="px-4 py-5">Nombre d'articles</th>
                        <th class="px-4 py-5">Statut</th>
                        <th class="px-4 py-5">Passée le</th>
                        <th class="px-4 py-5">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @forelse ($latest_preorders as $order)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <p class="font-semibold">#{{ $order->id }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm ml-8">
                                <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                    {{ $order->formatted_price }}€
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm ml-16">
                                <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                    {{ $order->order_items_count }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm ml-8 whitespace-nowrap">
                                <span class="rounded-full text-white bg-{{ $order->status->color }}-500 p-2">
                                    {{ $order->status->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                               {{ $order->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-blue-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Show">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19 6H17A5 5 0 0 0 7 6H5A2 2 0 0 0 3 8V20A2 2 0 0 0 5 22H12.05A6.5 6.5 0 0 1 9 16.5A6.4 6.4 0 0 1 10.25 12.68A5 5 0 0 1 7 8H9A3 3 0 0 0 12 11H12.06A6.22 6.22 0 0 1 14.06 10.16A3 3 0 0 0 15 8H17A4.88 4.88 0 0 1 16.54 10.09A6.5 6.5 0 0 1 21 13.09V8A2 2 0 0 0 19 6M9 6A3 3 0 0 1 15 6M19.31 18.9A4.5 4.5 0 1 0 17.88 20.32L21 23.39L22.39 22M15.5 19A2.5 2.5 0 1 1 18 16.5A2.5 2.5 0 0 1 15.5 19Z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Aucune précommande en cours.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            @if ($latest_preorders->isNotEmpty() && $latest_preorders->count() > 10)
                <p class="text-right mt-auto">
                    <a href="{{ route('admin.orders.index') }}" class="text-xs uppercase text-gray-500 hover:underline">Tout voir...</a>
                </p>
            @endif
        </section>
    </section>

</div>
@endsection
