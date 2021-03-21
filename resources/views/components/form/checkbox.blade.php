@props(['class', 'name'])
<div class="flex flex-col mt-6 text-sm">
    <label class="flex items-center dark:text-gray-400 @error($name) p-2 border border-red-400 @enderror">
        <input type="checkbox"
            class="form-checkbox h-5 w-5 {{ $class ?? 'focus:shadow-outline-primary focus:border-primary-400 text-primary-600' }}" name="{{ $name }}"
            value="{{ $value ?? 1 }}"
            {{ isset($isCheck) && $isCheck ? 'checked' : ''  }}
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }}
        />
        <span class="ml-2">
            {{ $slot }}
        </span>
    </label>

    @isset($helper)
        <div class="my-1">
            <small class="text-gray-500">{!! $helper !!}</small>
        </div>
    @endisset

    @error($name)
    <small class="text-sm text-red-400 my-1">
        {{ $message }}
    </small>
    @enderror
</div>
