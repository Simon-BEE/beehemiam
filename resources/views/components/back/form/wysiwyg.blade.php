@props(['name', 'required', 'value', 'helper', 'label'])
<div class="content-editor w-full my-4">
    <label for="{{ $name }}" class="text-sm font-medium leading-relaxed tracking-tighter text-gray-700 dark:text-gray-400 flex items-center justify-between">
        {{-- {{ $label }} --}}
    </label>
    <div class="toolbar">
        <div class="flex flex-wrap justify-center items-center space-x-2 mb-1 text-gray-700 dark:text-gray-400">
            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="bold" title="Bold">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M13.5,15.5H10V12.5H13.5A1.5,1.5 0 0,1 15,14A1.5,1.5 0 0,1 13.5,15.5M10,6.5H13A1.5,1.5 0 0,1 14.5,8A1.5,1.5 0 0,1 13,9.5H10M15.6,10.79C16.57,10.11 17.25,9 17.25,8C17.25,5.74 15.5,4 13.25,4H7V18H14.04C16.14,18 17.75,16.3 17.75,14.21C17.75,12.69 16.89,11.39 15.6,10.79Z" />
                    </svg>
                </button>
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="italic" title="Italic">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10,4V7H12.21L8.79,15H6V18H14V15H11.79L15.21,7H18V4H10Z" />
                    </svg>
                </button>
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="underline" title="Underline">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,21H19V19H5V21M12,17A6,6 0 0,0 18,11V3H15.5V11A3.5,3.5 0 0,1 12,14.5A3.5,3.5 0 0,1 8.5,11V3H6V11A6,6 0 0,0 12,17Z" />
                    </svg>
                </button>
            </div>
            
            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="insertUnorderedList" title="Insert list">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M7,5H21V7H7V5M7,13V11H21V13H7M4,4.5A1.5,1.5 0 0,1 5.5,6A1.5,1.5 0 0,1 4,7.5A1.5,1.5 0 0,1 2.5,6A1.5,1.5 0 0,1 4,4.5M4,10.5A1.5,1.5 0 0,1 5.5,12A1.5,1.5 0 0,1 4,13.5A1.5,1.5 0 0,1 2.5,12A1.5,1.5 0 0,1 4,10.5M7,19V17H21V19H7M4,16.5A1.5,1.5 0 0,1 5.5,18A1.5,1.5 0 0,1 4,19.5A1.5,1.5 0 0,1 2.5,18A1.5,1.5 0 0,1 4,16.5Z" />
                    </svg>
                </button>
            </div>

            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="insertHorizontalRule" title="Insert horizontal rule">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,13H5V11H19V13Z" />
                    </svg>
                </button>
            </div>
            
            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="undo" title="Undo">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12.5,8C9.85,8 7.45,9 5.6,10.6L2,7V16H11L7.38,12.38C8.77,11.22 10.54,10.5 12.5,10.5C16.04,10.5 19.05,12.81 20.1,16L22.47,15.22C21.08,11.03 17.15,8 12.5,8Z" />
                    </svg>
                </button>
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="removeFormat" title="Remove format">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M6,5V5.18L8.82,8H11.22L10.5,9.68L12.6,11.78L14.21,8H20V5H6M3.27,5L2,6.27L8.97,13.24L6.5,19H9.5L11.07,15.34L16.73,21L18,19.73L3.55,5.27L3.27,5Z" />
                    </svg>
                </button>
            </div>
            
            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="createLink" title="Insert Link">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3.9,12C3.9,10.29 5.29,8.9 7,8.9H11V7H7A5,5 0 0,0 2,12A5,5 0 0,0 7,17H11V15.1H7C5.29,15.1 3.9,13.71 3.9,12M8,13H16V11H8V13M17,7H13V8.9H17C18.71,8.9 20.1,10.29 20.1,12C20.1,13.71 18.71,15.1 17,15.1H13V17H17A5,5 0 0,0 22,12A5,5 0 0,0 17,7Z" />
                    </svg>
                </button>
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="unlink" title="Unlink">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17,7H13V8.9H17C18.71,8.9 20.1,10.29 20.1,12C20.1,13.43 19.12,14.63 17.79,15L19.25,16.44C20.88,15.61 22,13.95 22,12A5,5 0 0,0 17,7M16,11H13.81L15.81,13H16V11M2,4.27L5.11,7.38C3.29,8.12 2,9.91 2,12A5,5 0 0,0 7,17H11V15.1H7C5.29,15.1 3.9,13.71 3.9,12C3.9,10.41 5.11,9.1 6.66,8.93L8.73,11H8V13H10.73L13,15.27V17H14.73L18.74,21L20,19.74L3.27,3L2,4.27Z" />
                    </svg>
                </button>
            </div>
            
            <div class="format-category">
                <button type="button" class="editor-button p-2 rounded cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 text-center" data-action="code" title="Show HTML-Code">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M14.6,16.6L19.2,12L14.6,7.4L16,6L22,12L16,18L14.6,16.6M9.4,16.6L4.8,12L9.4,7.4L8,6L2,12L8,18L9.4,16.6Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="content-area">
        <div class="show-view block w-full mt-4 px-4 py-2 h-96 rounded border border-gray-200 bg-white dark:border-transparent dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" contenteditable>
            {!! isset($value) ? $value : old($name) ?? $label !!}
        </div>
        <textarea 
            class="html-view hidden px-4 py-2 w-full h-96 rounded border-gray-200 dark:border-transparent dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" 
            name={{ $name }}
            id={{ $name }}
            {{ ($required ?? false) ? 'required' : '' }}>
            {!! isset($value) ? $value : old($name) ?? '' !!}
        </textarea>
    </div>
    <div class="mt-2">

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
</div>