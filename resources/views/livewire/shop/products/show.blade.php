<section class="w-full flex flex-col md:flex-row items-start justify-between">
    {{-- Images --}}
    <section class="images w-full p-4 bg-primary-100  rounded shadow-lg md:w-1/3 overflow-x-hidden">
        <article class="w-full">
            <figure class="relative cursor-pointer group">
                <img src="{{ $currentOption->main_image->path }}" alt="{{ $currentOption->name }} image" class="rounded">
                <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                    <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                    </svg>
                </figcaption>
            </figure>
        </article>
        <article class="flex w-full justify-between mt-4">
            <figure class="relative cursor-pointer group">
                <img src="https://source.unsplash.com/150x150/daily?bohemian" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                    <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                    </svg>
                </figcaption>
            </figure>
            <figure class="relative cursor-pointer group">
                <img src="https://source.unsplash.com/150x150/daily?boho" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                    <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                    </svg>
                </figcaption>
            </figure>
            <figure class="relative cursor-pointer group">
                <img src="https://source.unsplash.com/150x150/daily?peace" alt="bohemian random" class="shadow-lg w-40 h-40 object-cover rounded">
                <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                    <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                    </svg>
                </figcaption>
            </figure>
        </article>
    </section>

    <section class="card w-full md:w-2/3 md:pl-8">
        {{ $currentOption->name }}
    </section>
</section>