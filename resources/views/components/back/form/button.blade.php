@props(['class', 'type'])

<button type="{{ $type ?? 'submit' }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple {{ $class ?? 'text-white bg-blue-600 active:bg-blue-600 hover:bg-blue-700' }}" {{ $attributes }}>
    {{ $slot }}
</button>

