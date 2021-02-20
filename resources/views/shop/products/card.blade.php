<a href="#" class="group flex flex-col relative bg-primary-200 p-4 rounded-lg items-center">
    
    <figure class="relative">
        <img src="https://source.unsplash.com/500x600/weekly?boho" alt="{{ $product->name }} image" class="w-full rounded shadow-xl">
        <figcaption class="absolute inset-0 w-full h-full transition-all duration-500 bg-black bg-opacity-0 group-hover:bg-opacity-50 flex flex-col items-center justify-center">
            <p class="bg-black bg-opacity-75 text-white transition-opacity duration-700 font-semibold px-3 py-2 rounded opacity-0 group-hover:opacity-100">Voir en détails</p>
        </figcaption>
    </figure>

    <h4 class="text-4xl font-bold my-5">{{ $product->name }}</h4>
    <p class="text-2xl w-1/2 text-center">{{ $product->optionFormattedPrice }}€</p>

</a>