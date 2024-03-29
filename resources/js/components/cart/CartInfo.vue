<template>
    <section class="bg-primary-200 p-4 rounded flex flex-col">
        <div class="text-center" v-if="loading">
            <loader />
        </div>
        <article class="flex flex-col" v-else>
            <div class="flex items-center justify-between mb-2">
                <h4 class="font-bold text-lg">Votre panier</h4>
                <a href="/panier" class="text-xs rounded p-1 bg-primary-400 text-white">Modifier</a>
            </div>

            <div
                v-for="product in products"
                :key="product.id"
                class="flex flex-col bg-primary-100 p-2 rounded"
            >
                <div class="flex flex-wrap items-center justify-between">
                    <a :href="product.product_option.path" class="flex items-center">
                        <img :src="product.product_option.images[0].path" :alt="product.product_option.name + ' image'" class="w-16 h-16 object-cover rounded">
                        <span class="ml-4 flex flex-col">
                            <span class="">
                                <h3 class="font-semibold text-lg mb-1">{{ product.product_option.name }}</h3>
                            </span>
                            <span class="flex items-center text-xs uppercase mt-2">
                                <span>Quantité: {{ product.cart_quantity }}</span>
                                <span class="font-semibold ml-2 px-2 py-1 rounded-full bg-primary-200">Taille {{ product.size.name }}</span>
                            </span>
                        </span>
                    </a>
                    <p class="my-3 md:my-0 flex md:flex-col items-center justify-center text-center">
                        <span class="font-bold text-xl">{{ product.product_option.formatted_price * product.cart_quantity }}€</span>
                        <span class="text-xs ml-1 md:ml-0">({{ product.product_option.formatted_price }}€ x {{ product.cart_quantity }})</span>
                    </p>
                    <!-- <button @click="removeProduct(product)" class="flex justify-center text-red-400 hover:bg-primary-300 rounded p-1" title="Supprimer du panier">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                        </svg>
                    </button> -->
                </div>
            </div>
        </article>

        <article class="flex flex-col my-5">
            <h4 class="font-bold text-lg mb-2">Livraison</h4>
            <p class="flex items-center">
                <svg class="mr-3 h-5 w-5" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                </svg>
                <span>
                    Livraison en <strong>{{ shippingFeesCountry }}</strong> par <strong>Colissimo</strong> - <strong>{{ formatNumber(shippingFeesAmount) }}€</strong>
                </span>
            </p>
        </article>

        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Montant total de la commande</h4>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Sous-total</p>
                <p class="font-semibold">{{ formatNumber(subTotal) }}€</p>
            </div>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Frais de livraison</p>
                <p class="font-semibold">{{ formatNumber(shippingFeesAmount) }}€</p>
            </div>
            <div class="flex items-center justify-between bg-primary-100 px-2 py-1 rounded" v-if="discount !== 0 && discountCode">
                <p>Code promo <span class="font-bold">{{ discountCode }}</span></p>
                <p class="font-semibold">-{{ formatNumber(discount) }}€</p>
            </div>

            <div class="pt-4 border-t border-primary-400 px-2 py-1 space-y-3">
                <div class="flex items-center justify-between">
                    <p>Sous-total HT</p>
                    <p class="font-semibold">{{ formatNumber(total - taxesFees - shippingFeesWithoutTaxes) }}€</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>Frais de livraison HT</p>
                    <p class="font-semibold">{{ formatNumber(shippingFeesWithoutTaxes) }}€</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>TVA</p>
                    <p class="font-semibold">{{ formatNumber(taxesFees) }}€</p>
                </div>
            </div>

            <div class="flex items-center justify-between font-black text-lg pt-3 border-t border-primary-400 px-2">
                <p>Montant total à payer</p>
                <p class="">{{ formatNumber(total) }}€</p>
            </div>

        </article>
    </section>
</template>

<script>
import Loader from '../LoaderIcon';

export default {
    components: { Loader },

    props: {
        cartSubTotal: {
            required: true,
            type: Number,
        },
        coupon: {
            type: Object,
        },
        cartItems: {
            required: true,
            type: Array,
        },
        countryId: {
            required: true,
        },
    },

    data() {
        return {
            loading: false,
            products: this.cartItems,
            subTotal: this.cartSubTotal,
            shippingFeesAmount: 4.95,
            shippingFeesCountry: 'France',
            total: 0,
            shippingFeesWithoutTaxes: 0,
            taxes: 0.2,
            taxesFees: 0,
            discount: this.coupon ? this.coupon.amount : 0,
            discountCode: this.coupon ? this.coupon.code : null,
        }
    },
    watch: {
        subTotal() {
            this.calculateCartTotalAmount();
        },
    },

    mounted() {
        this.calculateCartTotalAmount();
        this.getShippingFeesFromCountryId(this.countryId);
        this.getShippingCountryFromCountryId(this.countryId);

        window.addEventListener('country-selected', (event) => {
            this.getShippingFeesFromCountryId(event.detail.storage);
            this.getShippingCountryFromCountryId(event.detail.storage);

            this.calculateCartTotalAmount();
        });
    },

    methods: {
        calculateCartTotalAmount() {
            this.total = this.subTotal + this.shippingFeesAmount - this.discount;

            this.taxesFees = this.total * this.taxes;

            this.shippingFeesWithoutTaxes = this.shippingFeesAmount - (this.shippingFeesAmount * this.taxes);
        },

        getShippingFeesFromCountryId(countryId) {
            this.shippingFeesAmount = countryId == '1'
                ? 4.95
                : 12.90;

            this.calculateCartTotalAmount();
        },

        getShippingCountryFromCountryId(countryId) {
            this.shippingFeesCountry = countryId == '1'
                ? 'France métropolitaine'
                : (countryId == '2'
                    ? 'Belgique'
                    : 'Suisse' ) ;

                this.calculateCartTotalAmount();
        },
    },
}
</script>
