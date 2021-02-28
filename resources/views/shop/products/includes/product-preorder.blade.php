<div class=" flex flex-col space-y-6">
    <div class="title">
        <h2 class="font-bold text-4xl md:text-7xl">{{ $currentOption->name }}</h2>
        <p class="">
            @if ($currentOption->is_available)
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3M5 10.5L6.5 9L8 10.5L11.5 7L13 8.5L8 13.5L5 10.5Z" />
                </svg>
                <span class="text-xs uppercase">Le vêtement est actuellement disponible en précommande</span>
            </span>
            @endif
    </div>

    <article class="w-full md:w-2/3">
        <p>{!! $currentOption->description !!}</p>

        @if ($currentOption->is_available)
            <p class="p-4 rounded bg-primary-200 mt-2 flex items-center">
                <svg class="h-6 w-6 mr-3" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                </svg>
                <span>Le produit étant en précommande, la date de livraison est estimé à <strong>{{ $currentOption->release_date->diffForHumans() }}</strong>.</span>
            </p>
        @endif
    </article>

    @if ($currentOption->is_available)
        <x-form.form action="#" method="#" id="addCartForm">
            <article>
                <p class="font-semibold">Séléctionner ma taille</p>

                <sizes-selector :selected-size="{{ json_encode($selectedSize) }}" :sizes="{{ json_encode($sizes) }}" />
            </article>
    
            <article class="flex flex-col md:flex-row items-center mt-8 md:space-x-4">
                <span class="p-6 font-bold text-5xl bg-primary-300">{{ $currentOption->formatted_price }}€</span>

                <add-cart :product-option="{{ json_encode($currentOption) }}" :is-preorder="{{ json_encode(true) }}"></add-cart>
            </article>
        </x-form.form>
    @else
        <article class="bg-primary-300 p-8 rounded w-full md:w-2/3">
            <p class="font-bold">Le vêtement n'est plus disponible en précommande.</p>
            <a href="#" class="mt-4 p-5 rounded-lg bg-primary-100 inline-flex items-center text-primary-500 hover:bg-primary-200">
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10.07,14.27C10.57,14.03 11.16,14.25 11.4,14.75L13.7,19.74L15.5,18.89L13.19,13.91C12.95,13.41 13.17,12.81 13.67,12.58L13.95,12.5L16.25,12.05L8,5.12V15.9L9.82,14.43L10.07,14.27M13.64,21.97C13.14,22.21 12.54,22 12.31,21.5L10.13,16.76L7.62,18.78C7.45,18.92 7.24,19 7,19A1,1 0 0,1 6,18V3A1,1 0 0,1 7,2C7.24,2 7.47,2.09 7.64,2.23L7.65,2.22L19.14,11.86C19.57,12.22 19.62,12.85 19.27,13.27C19.12,13.45 18.91,13.57 18.7,13.61L15.54,14.23L17.74,18.96C18,19.46 17.76,20.05 17.26,20.28L13.64,21.97Z" />
                </svg>
                Je veux être averti lorsque le vêtement sera en vente
            </a>
        </article>
    @endif
</div>