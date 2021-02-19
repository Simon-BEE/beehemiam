@props(['class', 'type'])

<button type="{{ $type ?? 'submit' }}" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center {{ $class ?? 'bg-primary-500 text-white  hover:bg-primary-400 font-semibold' }}">
    {{ $slot }}
</button>