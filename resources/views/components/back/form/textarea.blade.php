@props(['classDiv', 'class', 'label', 'placeholder', 'name', 'value', 'required', 'helper', 'id'])
<div class="{{ $classDiv ?? 'w-full mb-4' }}">
    @if($label ?? null)
        <label class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400 flex items-center justify-between" for="{{ $name }}">
            {{ $label }}
            @if(empty($required))
                <span class="text-xs uppercase text-gray-500">{{ __('Optionnel') }}</span>
            @endif
        </label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="w-full h-60 mt-2 px-4 py-2 block rounded border-gray-200 dark:border-transparent dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray @error($name) border-red-500 @enderror {{ $class ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes }}
    >{{ isset($value) ? $value : old($name) }}</textarea>

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
</div>
