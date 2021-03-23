@extends('layouts.back')

@section('meta-title')
    Voir toutes les transactions
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
            <p>Voir toutes les transactions</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir toutes les transactions
            </h2>
        </div>

        <x-back.filter action="">
            <x-back.form.input
                classDiv="w-full md:w-1/2"
                name="method"
                type="text"
                label="Moyen de paiement"
                placeholder="Moyen de paiement"
                value="{{ old('method') ?? request()->get('method') }}"
            />

            <div class="w-full md:w-1/2 md:ml-6">
                <label for="type" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400 flex items-center justify-between">Type</label>
                <div class="relative w-full border-none mt-2">
                    <select
                        class="bg-white dark:bg-gray-700 text-gray-500 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-gray-500 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full"
                        id="type"
                        name="type"
                        required
                    >
                        <option value="#" selected disabled>Choisissez un statut</option>
                        <option value="refund" {{ request()->get('type') == 0 ? 'refund' : '' }}>Remboursement</option>
                        <option value="payment" {{ request()->get('type') == 0 ? 'payment' : '' }}>Paiement</option>
                        <option value="both" {{ request()->get('type') == 0 ? 'both' : '' }}>Les deux</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 md:ml-6">
                <x-back.form.button>
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                    </svg>
                    Affiner les résultats
                </x-back.form.button>
            </div>
        </x-back.filter>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-5">Type</th>
                            <th class="px-4 py-5">Montant</th>
                            <th class="px-4 py-5">Moyen</th>
                            <th class="px-4 py-5">Référence</th>
                            <th class="px-4 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($transactions as $transaction)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    @if ($transaction instanceof \App\Models\Payment)
                                        <span class="text-white text-xs uppercase rounded-xl px-2 py-1 bg-blue-500">Paiement</span>
                                    @else
                                        <span class="text-white text-xs uppercase rounded-xl px-2 py-1 bg-pink-500">Remboursement</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                        {{ $transaction->formatted_amount }}€
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <span class="rounded-full bg-gray-100 dark:bg-gray-900 p-2">
                                        {{ $transaction->type === 'card' ? 'Carte bancaire' : 'Paypal' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-white">
                                   {{ $transaction->reference }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ $transaction->path }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-purple-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    Aucune transaction n'a été trouvée.</a>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
@endsection
