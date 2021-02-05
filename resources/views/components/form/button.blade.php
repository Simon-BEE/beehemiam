@props(['class', 'type'])

<button type="{{ $type ?? 'submit' }}" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center {{ $class ?? 'bg-gray-100 hover:text-gray-600 hover:bg-gray-200' }}">
    {{ $slot }}
</button>