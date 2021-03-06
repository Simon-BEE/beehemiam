<section class="mb-12">
    @if ($user->address)
        <section class="flex flex-col p-8 rounded-xl border border-dashed border-primary-400 ">

            <div class="space-y-3 mb-8">
                <p>{{ $user->address->is_billing ? 'Cette adresse est selectionnée et prête à être utilisée' : 'Ces adresses sont selectionnées et prêtes à être utilisées' }}, si cela vous convient vous pouvez passer à la prochaine étape.</p>
                <p>Si ce n'est pas le cas, vous pouvez directement enregistrer une nouvelle adresse ci-dessous, elle sera utilisée pour votre commande.</p>
                @if ($user->addresses->where('is_billing', false)->count() > 1)
                    <p>Vous pouvez également utiliser d'autres adresses enregistrées en cliquant sur le bouton <strong>Changer</strong>.</p>
                @endif
            </div>

            <div class="relative border border-primary-400 p-4 rounded-sm w-full flex flex-col space-y-2">
                <h3 class="absolute -top-3 py-1 px-4 bg-primary-100 uppercase text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                    </svg>
                    Adresse selectionnée <strong class="ml-1">{{ $user->address->name }}</strong>
                </h3>
    
                <div class="absolute top-4 right-2 opacity-75 flex md:flex-col">
                    <p class="flex items-center text-sm">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                        </svg>
                        <span class="hidden md:inline">Adresse de livraison</span>
                    </p>
                    @if ($user->address->is_billing)
                        <p class="flex items-center text-sm md:mt-3">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z" />
                            </svg>
                            <span class="hidden md:inline">Adresse de facturation</span>
                        </p>
                    @endif
                </div>
    
                @if ($user->addresses->where('is_billing', false)->count() > 1)
                    <div class="absolute -bottom-5 right-4 px-3 py-2 bg-primary-100">
                        <a href="{{ route('user.addresses.index') }}" class="rounded bg-primary-500 px-2 py-1 flex items-center text-white font-bold">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M17,4H7A5,5 0 0,0 2,9V20H20A2,2 0 0,0 22,18V9A5,5 0 0,0 17,4M10,18H4V9A3,3 0 0,1 7,6A3,3 0 0,1 10,9V18M20,18H12V9C12,7.92 11.65,6.86 11,6H17A3,3 0 0,1 20,9V18M13,11V13H17V15H19V11H13M9,11H5V9H9V11Z" />
                            </svg>
                            Changer
                        </a>
                    </div>
                @endif
    
                <article class="p-3 flex items-center flex-wrap rounded">
                    <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                    </svg>
                    <span class="mr-3">
                        <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                        <span>{{ $user->address->firstname }}</span>
                    </span>
                    <span>
                        <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                        <span>{{ $user->address->lastname }}</span>
                    </span>
                </article>
    
                <article class="p-3 flex items-center flex-wrap rounded">
                    <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                    </svg>
                    <span class="mr-3">
                        <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                        <span>{{ $user->address->street }} {{ $user->address->additionnal }}</span>
                    </span>
                    <span class="mr-3">
                        <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                        <span>{{ $user->address->city }} {{ $user->address->zipcode }}</span>
                    </span>
                    <span>
                        <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                        <span>{{ $user->address->country->name }}</span>
                    </span>
                </article>
    
                <article class="p-3 flex items-center flex-wrap rounded">
                    <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                    </svg>
                    @if ($user->address->email)
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                            <span>{{ $user->address->email }}</span>
                        </span>
                    @endif
                    @if ($user->address->phone)
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                            <span>{{ $user->address->phone }}</span>
                        </span>
                    @endif
                </article>
            </div>
    
            @if (!$user->address->is_billing)
                @php
                    $address = $user->addresses->firstWhere('is_billing', true);
                @endphp
                <div class="relative border border-primary-400 p-4 rounded-sm w-full flex flex-col space-y-2 mt-6">
                    <h3 class="absolute -top-3 py-1 px-4 bg-primary-100 uppercase text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                        </svg>
                        Adresse selectionnée <strong class="ml-1">{{ $address->name }}</strong>
                    </h3>
    
                    <div class="absolute top-4 right-2 opacity-75 flex md:flex-col">
                        <p class="flex items-center text-sm md:mt-3">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z" />
                            </svg>
                            <span class="hidden md:inline">Adresse de facturation</span>
                        </p>
                    </div>
    
                    @if ($user->addresses->where('is_billing', false)->count() > 1)
                        <div class="absolute -bottom-5 right-4 px-3 py-2 bg-primary-100">
                            <a href="{{ route('user.addresses.index') }}" class="rounded bg-primary-500 px-2 py-1 flex items-center text-white font-bold">
                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M17,4H7A5,5 0 0,0 2,9V20H20A2,2 0 0,0 22,18V9A5,5 0 0,0 17,4M10,18H4V9A3,3 0 0,1 7,6A3,3 0 0,1 10,9V18M20,18H12V9C12,7.92 11.65,6.86 11,6H17A3,3 0 0,1 20,9V18M13,11V13H17V15H19V11H13M9,11H5V9H9V11Z" />
                                </svg>
                                Changer
                            </a>
                        </div>
                    @endif
    
                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22,3H2C0.91,3.04 0.04,3.91 0,5V19C0.04,20.09 0.91,20.96 2,21H22C23.09,20.96 23.96,20.09 24,19V5C23.96,3.91 23.09,3.04 22,3M22,19H2V5H22V19M14,17V15.75C14,14.09 10.66,13.25 9,13.25C7.34,13.25 4,14.09 4,15.75V17H14M9,7A2.5,2.5 0 0,0 6.5,9.5A2.5,2.5 0 0,0 9,12A2.5,2.5 0 0,0 11.5,9.5A2.5,2.5 0 0,0 9,7M14,7V8H20V7H14M14,9V10H20V9H14M14,11V12H18V11H14" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Prénom</span>
                            <span>{{ $address->firstname }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Nom</span>
                            <span>{{ $address->lastname }}</span>
                        </span>
                    </article>
    
                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,3L2,12H5V20H19V12H22L12,3M12,8.75A2.25,2.25 0 0,1 14.25,11A2.25,2.25 0 0,1 12,13.25A2.25,2.25 0 0,1 9.75,11A2.25,2.25 0 0,1 12,8.75M12,15C13.5,15 16.5,15.75 16.5,17.25V18H7.5V17.25C7.5,15.75 10.5,15 12,15Z" />
                        </svg>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Rue</span>
                            <span>{{ $address->street }} {{ $address->additionnal }}</span>
                        </span>
                        <span class="mr-3">
                            <span class="mr-2 text-xs uppercase text-gray-500">Ville</span>
                            <span>{{ $address->city }} {{ $address->zipcode }}</span>
                        </span>
                        <span>
                            <span class="mr-2 text-xs uppercase text-gray-500">Pays</span>
                            <span>{{ $address->country->name }}</span>
                        </span>
                    </article>
    
                    <article class="p-3 flex items-center flex-wrap rounded">
                        <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                        </svg>
                        @if ($address->email)
                            <span class="mr-3">
                                <span class="mr-2 text-xs uppercase text-gray-500">Email</span>
                                <span>{{ $address->email }}</span>
                            </span>
                        @endif
                        @if ($address->phone)
                            <span>
                                <span class="mr-2 text-xs uppercase text-gray-500">Téléphone</span>
                                <span>{{ $address->phone }}</span>
                            </span>
                        @endif
                    </article>
                </div>
            @endif
        </section>
    @else
        <x-info>
            <p>Aucune adresse n'est enregistré avec votre compte, pour continuer veuillez en créer une ci-dessous.</p>
        </x-info>
    @endif
</section>

<x-form.form id="addressForm" action="{{ route('cart.shippings.store') }}" method="POST" class="flex flex-col p-8 rounded-xl border border-dashed border-primary-400">
    <h2 class="text-xl font-bold text-primary-500 mx-auto inline-flex items-center">
        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
            <path fill="currentColor" d="M8,4A5,5 0 0,0 3,9V18H1V20H21A2,2 0 0,0 23,18V9A5,5 0 0,0 18,4H8M8,6A3,3 0 0,1 11,9V18H5V9A3,3 0 0,1 8,6M13,13V7H17V9H15V13H13Z" />
        </svg>
        @if ($user->address)
            Enregistrer une autre adresse de livraison
        @else
            Votre adresse de livraison
        @endif
    </h2>

    <section class="py-2 my-6 w-full flex flex-col" id="addressForm">

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
            <x-form.input-bis 
                classDiv="w-full"
                name="firstname"
                type="text"
                label="Prénom"
                placeholder="Prénom"
                value="{{ old('firstname') 
                    ?? session('shipping_address')?->firstname
                    ?? session('billing_address')?->firstname
                }}"
                required="{{ $user->address ? false : true }}"
            />
            <x-form.input-bis 
                classDiv="w-full"
                name="lastname"
                type="text"
                label="Nom de famille"
                placeholder="Nom de famille"
                value="{{ old('lastname') 
                    ?? session('shipping_address')?->lastname
                    ?? session('billing_address')?->lastname
                }}"
                required="{{ $user->address ? false : true }}"
            />
        </div>

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-3 mb-4">
            <x-form.input-bis 
                classDiv="w-full"
                name="email"
                type="email"
                label="Adresse email"
                placeholder="Adresse email"
                value="{{ old('email') 
                    ?? session('shipping_address')?->email
                    ?? session('billing_address')?->email
                }}"
                required="{{ $user->address ? false : true }}"
            />
            <x-form.input-bis 
                classDiv="w-full"
                name="phone"
                type="text"
                label="Numéro de télephone"
                placeholder="Numéro de télephone"
                value="{{ old('phone') 
                    ?? session('shipping_address')?->phone
                    ?? session('billing_address')?->phone
                }}"
                required="{{ $user->address ? false : true }}"
            />
        </div>

        <x-form.input-bis 
            name="street"
            type="text"
            label="Adresse"
            placeholder="Adresse"
            value="{{ old('street') 
                ?? session('shipping_address')?->street
                ?? session('billing_address')?->street
            }}"
            required="{{ $user->address ? false : true }}"
        />

        <x-form.input-bis 
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
            <x-form.input-bis 
                classDiv="w-full"
                name="city"
                type="text"
                label="Ville"
                placeholder="Ville"
                value="{{ old('city') 
                    ?? session('shipping_address')?->city
                    ?? session('billing_address')?->city
                }}"
                required="{{ $user->address ? false : true }}"
            />

            <x-form.input-bis 
                classDiv="w-full"
                name="zipcode"
                type="text"
                label="Code postal"
                placeholder="Code postal"
                value="{{ old('zipcode') 
                    ?? session('shipping_address')?->zipcode
                    ?? session('billing_address')?->zipcode
                }}"
                required="{{ $user->address ? false : true }}"
            />

            <x-form.select label="Choisir un pays" name="country_id" required="{{ $user->address ? false : true }}"
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