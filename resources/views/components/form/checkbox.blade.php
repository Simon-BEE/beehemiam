@props(['class', 'name'])
<div class="flex mt-6 text-sm">
    <label class="flex items-center dark:text-gray-400">
        <input type="checkbox" 
            class="form-checkbox focus:outline-none dark:focus:shadow-outline-gray {{ $class ?? 'focus:shadow-outline-primary focus:border-primary-400 text-primary-600' }}" name="{{ $name }}" 
            value="1"
        />
        <span class="ml-2">
            {{ $slot }}
        </span>
    </label>
</div>