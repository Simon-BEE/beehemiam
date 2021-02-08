@props(['label', 'placeholder', 'name', 'required', 'helper', 'classDiv'])
<div class="{{ $classDiv ?? 'flex flex-wrap mb-4' }}">
    <label 
        class="w-full flex flex-col items-center px-4 py-6 bg-white dark:bg-gray-800 text-gray-500 rounded-lg shadow-lg tracking-wide uppercase cursor-pointer border border-dashed border-transparent hover:border-gray-500 transition-all duration-300">
        <svg class="w-12 h-12" viewBox="0 0 24 24">
            <path fill="currentColor" d="M7,15L11.5,9L15,13.5L17.5,10.5L21,15M22,4H14L12,2H6A2,2 0 0,0 4,4V16A2,2 0 0,0 6,18H22A2,2 0 0,0 24,16V6A2,2 0 0,0 22,4M2,6H0V11H0V20A2,2 0 0,0 2,22H20V20H2V6Z" />
        </svg>
        <span class="mt-2 font-semibold">{{ $label }}</span>
        <input type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            class="hidden"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }} 
        />
    </label>

    @isset($helper)
        <div class="my-1">
            <small class="text-gray-500">{!! $helper !!}</small>
        </div>
    @endisset

    @error($name)
        <small class="text-sm text-red-500">
            {{ $message }}
        </small>
    @enderror

    <div class="previews my-3 flex flex-wrap justify-center items-center md:space-x-4">
    </div>
</div>