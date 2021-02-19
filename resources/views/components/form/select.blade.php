@props(['name', 'label', 'class', 'multiple', 'classDiv', 'required'])

<div class="{{ $classDiv ?? 'w-full mb-4' }}">
    <label for="{{ $name }}" class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center justify-between">{{ $label }}</label>
    <div class="relative w-full border-none mt-2">
        <select
            class="bg-primary-200 text-kaki-900 appearance-none border-none focus:outline-none focus:ring-2 focus:ring-primary-500 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full {{ $class ?? '' }}"
            id="{{ $name }}"
            name="{{ $name }}" 
            {{ ($required ?? false) ? 'required' : '' }}
            {{ ($mutliple ?? false) ? "multiple" : '' }} 
        >
            {{ $slot }}
        </select>
    </div>
</div>
