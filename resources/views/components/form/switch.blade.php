@props(['name', 'value', 'isCheck'])
<label 
    for="{{ $name }}"
    class="flex items-center cursor-pointer"
  >
    <!-- toggle -->
    <div class="relative">
      <!-- input -->
      <input 
        id="{{ $name }}" 
        type="checkbox" 
        class="hidden" 
        name="{{ $name }}" 
        value="{{ $value ?? 1 }}"
        {{ isset($isCheck) && $isCheck ? 'checked' : ''  }}
        {{ $attributes }} 
      />
      <!-- line -->
      <div
        class="toggle__line w-10 h-4 bg-primary-700 rounded-full shadow-inner"
      ></div>
      <!-- dot -->
      <div
        class="toggle__dot front-switch absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"
      ></div>
    </div>
    <!-- label -->
    <div
      class="ml-3 text-gray-700 dark:text-gray-400 font-medium"
    >
      {{ $slot }}
    </div>
</label>