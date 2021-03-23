@extends('layouts.back')

@section('meta-title')
    Voir tous les messages
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
            <p>Voir tous les messages</p>
        </section>

        <div class="title my-6 flex flex-col lg:flex-row items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Voir tous les messages
            </h2>
        </div>

        <x-back.filter action="">
            <x-back.form.input
                classDiv="w-full md:w-1/3"
                name="email"
                type="text"
                label="Adresse email"
                placeholder="Adresse email"
                value="{{ old('email') ?? request()->get('email') }}"
            />

            <x-back.form.input
                classDiv="w-full md:w-1/3 md:ml-6"
                name="object"
                type="text"
                label="Sujet du message"
                placeholder="Sujet du message"
                value="{{ old('object') ?? request()->get('object') }}"
            />

            <div class="w-full md:w-1/3 md:ml-6">
                <label for="read" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400 flex items-center justify-between">Lecture</label>
                <div class="relative w-full border-none mt-2">
                    <select
                        class="bg-white dark:bg-gray-700 text-gray-500 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-gray-500 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full"
                        id="read"
                        name="read"
                        required
                    >
                        <option value="#" selected disabled>Choisissez un statut</option>
                        <option value="read" {{ request()->get('type') == 0 ? 'read' : '' }}>Lu</option>
                        <option value="unread" {{ request()->get('type') == 0 ? 'unread' : '' }}>Non-lu</option>
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
                            <th class="px-4 py-5">Lu</th>
                            <th class="px-4 py-5">Email</th>
                            <th class="px-4 py-5">Sujet</th>
                            <th class="px-4 py-5">Envoyé le</th>
                            <th class="px-4 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($messages as $message)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm ml-8">
                                    @if ($message->read_at)
                                    <span class="rounded-full bg-green-500 text-white px-2 py-1">
                                        LU
                                    </span>
                                    @else
                                    <span class="rounded-full bg-red-500 text-white px-2 py-1">
                                        NON-LU
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold">{{ $message->email }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <p class="font-semibold">{{ $message->object }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ml-8">
                                    <p class="font-semibold">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="#"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-purple-500 dark:hover:text-white focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">
                                    Aucun message trouvé.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $messages->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
@endsection
