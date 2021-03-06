<article class="mb-4 text-center flex flex-col space-y-4">
    <a href="{{ route('register') }}" class="text-xl font-bold text-primary-500 hover:bg-primary-200 transition-colors duration-300 flex justify-center items-center p-8 rounded-xl border border-dashed border-primary-400">
        <svg viewBox="0 0 24 24" class="w-6 h-6 mr-3">
            <path fill="currentColor" d="M8,12H16V14H8V12M10,20H6V4H13V9H18V12.1L20,10.1V8L14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H10V20M8,18H12.1L13,17.1V16H8V18M20.2,13C20.3,13 20.5,13.1 20.6,13.2L21.9,14.5C22.1,14.7 22.1,15.1 21.9,15.3L20.9,16.3L18.8,14.2L19.8,13.2C19.9,13.1 20,13 20.2,13M20.2,16.9L14.1,23H12V20.9L18.1,14.8L20.2,16.9Z"></path>
        </svg>
        Créez-vous un compte
    </a>
    <a href="{{ route('login') }}" class="text-xl font-bold text-primary-500 hover:bg-primary-200 transition-colors duration-300 flex justify-center items-center p-8 rounded-xl border border-dashed border-primary-400">
        <svg viewBox="0 0 24 24" class="w-6 h-6 mr-3">
            <path fill="currentColor" d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z"></path>
        </svg>
        Connectez-vous
    </a>
</article>

<x-form.form id="addressForm" action="{{ route('cart.shippings.store') }}" method="POST" class="flex flex-col p-8 rounded-xl border border-dashed border-primary-400">
    <h2 class="text-xl font-bold text-primary-500 mx-auto inline-flex items-center">
        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8,4A5,5 0 0,0 3,9V18H1V20H21A2,2 0 0,0 23,18V9A5,5 0 0,0 18,4H8M8,6A3,3 0 0,1 11,9V18H5V9A3,3 0 0,1 8,6M13,13V7H17V9H15V13H13Z" />
        </svg>
        Passer commande sans créer de compte
    </h2>

    <p class="my-4 text-center">Pour cela, vous devez définir votre adresse de livraison ci-dessous.</p>

    <section class="py-2 my-6 w-full flex flex-col" id="addressForm">

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
            <x-form.input 
                classDiv="w-full"
                name="firstname"
                type="text"
                label="Prénom"
                placeholder="Prénom"
                value="{{ old('firstname') 
                    ?? session('shipping_address')?->firstname
                    ?? session('billing_address')?->firstname
                }}"
                required
            />
            <x-form.input 
                classDiv="w-full"
                name="lastname"
                type="text"
                label="Nom de famille"
                placeholder="Nom de famille"
                value="{{ old('lastname') 
                    ?? session('shipping_address')?->lastname
                    ?? session('billing_address')?->lastname
                }}"
                required
            />
        </div>

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
            <x-form.input 
                classDiv="w-full"
                name="email"
                type="email"
                label="Adresse email"
                placeholder="Adresse email"
                value="{{ old('email') 
                    ?? session('shipping_address')?->email
                    ?? session('billing_address')?->email
                }}"
                required
            />
            <x-form.input 
                classDiv="w-full"
                name="phone"
                type="text"
                label="Numéro de télephone"
                placeholder="Numéro de télephone"
                value="{{ old('phone') 
                    ?? session('shipping_address')?->phone
                    ?? session('billing_address')?->phone
                }}"
                required
            />
        </div>

        <x-form.input 
            name="street"
            type="text"
            label="Adresse"
            placeholder="Adresse"
            value="{{ old('street') 
                ?? session('shipping_address')?->street
                ?? session('billing_address')?->street
            }}"
            required
        />

        <x-form.input 
            name="additionnal"
            type="text"
            label="Complément d'adresse"
            placeholder="Complément d'adresse"
            value="{{ old('additionnal') 
                ?? session('shipping_address')?->additionnal
                ?? session('billing_address')?->additionnal
            }}"
        />

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
            <x-form.input 
                classDiv="w-full"
                name="city"
                type="text"
                label="Ville"
                placeholder="Ville"
                value="{{ old('city') 
                    ?? session('shipping_address')?->city
                    ?? session('billing_address')?->city
                }}"
                required
            />

            <x-form.input 
                classDiv="w-full"
                name="zipcode"
                type="text"
                label="Code postal"
                placeholder="Code postal"
                value="{{ old('zipcode') 
                    ?? session('shipping_address')?->zipcode
                    ?? session('billing_address')?->zipcode
                }}"
                required
            />

            <x-form.select label="Choisir un pays" name="country_id" required
                onchange="window.dispatchEvent(new CustomEvent('country-selected', {
                    detail: {
                        storage: this.value,
                    }
                }));"
            >
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </x-form.select>
        </div>

    </section>

    <billing-address></billing-address>

</x-form.form>