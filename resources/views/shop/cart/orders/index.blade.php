@extends('layouts.app')

@section('meta-title')Validation et paiement @endsection

@section('content')

<section class="breadcrumb -mt-6 mb-6 p-0 md:p-4 flex items-center md:justify-end flex-wrap space-x-2 text-kaki-800">
    <svg class="w-4 h-4" viewBox="0 0 24 24">
        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
    </svg>
    <a href="{{ route('cart.index') }}" class="hover:text-primary-600">Mon panier</a>
    <span class="text-primary-500">/</span>
    <a href="{{ route('cart.shippings.index') }}" class="hover:text-primary-600">Adresse et livraison</a>
    <span class="text-primary-500">/</span>
    <p>Validation et paiement</p>
</section>

<section class="flex flex-col items-center justify-center p-4 lg:p-0 overflow-x-hidden">
    <article class="w-full md:w-1/2 text-center mb-12">
        <h1 class="text-5xl md:text-7xl font-cursive">Validation et paiement</h1>
        <p class="mt-8">Dernière étape pour passer commande, le paiement. Vérifier vos informations enregistrées précédemment, puis choissisez votre moyen de paiement. Vous avez le choix entre <strong>PayPal</strong> et le paiement par <strong>Carte Bancaire</strong>. Pour toutes autres informations, nous vous invitons à vous rendre sur  <a href="#" class="text-primary-500 hover:underline">la page dédiée aux commandes</a>.</p>
    </article>

    @include('shop.cart.includes.order-preorder-alert')

    <section class="w-full flex flex-col lg:flex-row items-start justify-between lg:space-x-4 mt-12">

        <section class="w-full lg:w-1/2 px-4 pt-4 pb-12 rounded bg-primary-200 relative">
            <a href="{{ route('cart.shippings.index') }}" class="absolute bottom-2 right-2 rounded bg-primary-500 px-3 py-2 flex items-center text-white font-bold">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                </svg>
                Changer mes informations
            </a>

            <h3 class="text-lg font-bold">Vos informations personnelles</h3>
            <p class="flex items-center py-2">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z" />
                </svg>
                <strong class="mx-1">Adresse email :</strong>
                <span>{{ $contactEmail }}</span>
            </p>
            <div class="py-2">
                <div class="flex items-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17,4H7A5,5 0 0,0 2,9V20H20A2,2 0 0,0 22,18V9A5,5 0 0,0 17,4M10,18H4V9A3,3 0 0,1 7,6A3,3 0 0,1 10,9V18M20,18H12V9C12,7.92 11.65,6.86 11,6H17A3,3 0 0,1 20,9V18M13,11V13H17V15H19V11H13M9,11H5V9H9V11Z" />
                    </svg>
                    <strong class="mx-1">Adresse de livraison :</strong>
                </div>
                <div class="">
                    <p>
                        {{ $shippingAddress->firstname }} {{ $shippingAddress->lastname }}
                    </p>
                    <p>
                        {{ $shippingAddress->street }} {{ $shippingAddress->additionnal }} {{ $shippingAddress->city }} {{ $shippingAddress->zipcode }} - {{ $shippingAddress->country->name }}
                    </p>
                </div>
            </div>
            <div class="py-2">
                <div class="flex items-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z" />
                    </svg>
                    <strong class="mx-1">Adresse de facturation :</strong>
                </div>
                <div class="">
                    <p>
                        {{ $billingAddress->firstname }} {{ $billingAddress->lastname }}
                    </p>
                    <p>
                        {{ $billingAddress->street }} {{ $billingAddress->additionnal }} {{ $billingAddress->city }} {{ $billingAddress->zipcode }} - {{ $billingAddress->country->name }}
                    </p>
                </div>
            </div>
        </section>

        <section class="w-full lg:w-1/2 px-4 pt-4 pb-12 rounded bg-primary-200 relative">
            <a href="{{ route('cart.shippings.index') }}" class="absolute bottom-2 right-2 rounded bg-primary-500 px-3 py-2 flex items-center text-white font-bold">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                </svg>
                Modifier
            </a>

            <h3 class="text-lg font-bold">Votre mode de livraison</h3>
            <p class="flex items-center py-2">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                </svg>
                <span>
                    Transport par <strong>Colissimo (La Poste)</strong>.
                </span>
            </p>
            <p class="flex items-center py-2">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" />
                </svg>
                <span>
                    Livraison estimée <strong>{{ $estimatedShippingDate }}</strong>.
                </span>
            </p>
        </section>

    </section>



    <section class="w-full rounded bg-primary-200 relative mt-12 flex flex-col-reverse lg:flex-row items-start justify-between lg:space-x-4">

        <section class="w-full lg:w-2/3 px-4 pt-4 pb-12 rounded bg-primary-200 relative text-center">
            <h2 class="text-2xl lg:text-4xl font-bold mt-8 mb-16">Choisissez votre méthode de paiement</h2>
            <stripe-payment></stripe-payment>
        </section>


        <section class="w-full lg:w-1/3 px-4 pt-4 pb-12 rounded bg-primary-200 relative">
            <cart-info
                :cart-items="{{ json_encode($cart) }}"
                :coupon="{{ json_encode($coupon) }}"
                :cart-sub-total="{{ $subTotal }}"
                :country-id="{{ json_encode($shippingAddress->country_id) }}"
            ></cart-info>
        </section>
    </section>

</section>

@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush
