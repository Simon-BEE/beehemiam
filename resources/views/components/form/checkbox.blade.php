@props(['class', 'name'])
<div class="flex mt-6 text-sm">
    <label class="flex items-center dark:text-gray-400">
        <input type="checkbox" 
            class="form-checkbox h-5 w-5 {{ $class ?? 'focus:shadow-outline-primary focus:border-primary-400 text-primary-600' }}" name="{{ $name }}" 
            value="{{ $value ?? 1 }}"
            {{ isset($isCheck) && $isCheck ? 'checked' : ''  }}
            {{ $attributes }}
        />
        <span class="ml-2">
            {{ $slot }}
        </span>
    </label>
</div>