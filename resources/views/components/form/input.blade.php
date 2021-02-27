@props(['classDiv', 'class', 'type', 'label', 'placeholder', 'name', 'value', 'required', 'helper'])
<div class="{{ $classDiv ?? 'w-full mb-4' }}">
    @if($label ?? null)
        <label class="text-sm font-medium leading-relaxed tracking-tighter text-kaki-900 flex items-center" for="{{ $name }}">
            {{ $label }}
            @if(empty($required))
                <span class="text-xs uppercase text-kaki-800 ml-1 md:ml-3">Facultatif</span>
            @endif
        </label>
    @endif
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 @error($name) border-red-500 @enderror {{ $class ?? 'bg-primary-200' }}"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ isset($value) ? $value : old($name) }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes }}
    >

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