@props(['action'])

<section class="text-gray-700 dark:text-gray-200 p-4 rounded bg-gray-200 dark:bg-gray-800 mb-4 relative">
    <details>
        <summary class="list-none focus:outline-none cursor-pointer">Filtrer les résultats</summary>
        <form method="GET" action="{{ $action }}" class="p-4">
            <a href="{{ route(request()->route()->getName()) }}" class="absolute top-2 right-2 px-2 py-1 bg-blue-600 text-white rounded text-sm">
                Réinitialiser
            </a>
            <div class="flex flex-col md:flex-row items-end">
                {{ $slot }}
            </div>
        </form>
    </details>
</section>
