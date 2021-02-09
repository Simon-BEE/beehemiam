@props(['class', 'type'])

<button type="{{ $type ?? 'submit' }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple {{ $class ?? '' }}">
    {{ $slot }}
</button>

