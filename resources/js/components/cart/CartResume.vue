<template>
    <section class="bg-primary-200 p-4 rounded flex flex-col space-y-4">
        <div class="text-center" v-if="loading">
            <loader />
        </div>
        <article class="flex flex-col" v-else>
            <h4 class="font-bold text-lg mb-2">Vous avez un code promo ?</h4>

            <form class="flex items-center" @submit.prevent="submitCoupon">
                <div class="w-full mb-2">
                    <input 
                        type="text" name="discount" id="discount" 
                        placeholder="Code promo" required="required" 
                        class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-100"
                        v-model="discountCodeInput"
                    >
                </div>
                <button type="submit" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center bg-primary-500 text-white  hover:bg-primary-400 font-semibold ml-2">
                    Ajouter
                </button>
            </form>
            <small class="text-red-400" v-if="errorCoupon">{{ errorCoupon }}</small>
            <small class="text-green-400" v-if="successCoupon">{{ successCoupon }}</small>
        </article>
        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Montant total de la commande</h4>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Sous-total</p>
                <p class="font-semibold">{{ formatNumber(subTotal) }}€</p>
            </div>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Frais de livraison*</p>
                <p class="font-semibold">{{ formatNumber(shippingFees) }}€</p>
            </div>
            <div class="flex items-center justify-between bg-primary-100 px-2 py-1 rounded" v-if="discount !== 0 && discountCode">
                <p>Code promo <span class="font-bold">{{ discountCode }}</span></p>
                <p class="font-semibold">-{{ discount }}€</p>
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
                <p>Montant total à  payer</p>
                <p class="">{{ formatNumber(total) }}€</p>
            </div>

            <p class="text-xs pt-4 text-right">*Estimation pour une livraison en France métropolitaine</p>
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
    },

    data() {
        return {
            loading: false,
            subTotal: this.cartSubTotal,
            shippingFees: 4.95,
            shippingFeesWithoutTaxes: 0,
            total: 0,
            taxes: 0.2,
            taxesFees: 0,
            discount: this.coupon ? this.coupon.amount : 0,
            discountCode: this.coupon ? this.coupon.code : null,
            discountCodeInput: '',
            errorCoupon: null,
            successCoupon: null,
        }
    },
    watch: {
        subTotal() {
            this.calculateCartTotalAmount();
        },
    },
    
    mounted() {
        this.calculateCartTotalAmount();

        window.addEventListener('cart-amount-change', (event) => {
            this.subTotal = event.detail.storage;
        });
    },

    methods: {
        calculateCartTotalAmount() {
            this.total = this.subTotal + this.shippingFees - this.discount;

            this.taxesFees = this.total * this.taxes;

            this.shippingFeesWithoutTaxes = this.shippingFees - (this.shippingFees * this.taxes);
        },

        submitCoupon() {
            this.loading = true;
            this.errorCoupon = null;
            this.successCoupon = null;

            axios.post('/cart/coupons/add/', 
                {coupon: this.discountCodeInput}, 
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }).then(response => {
                this.successCoupon = response.data.message;

                setTimeout(() => {
                    this.successCoupon = null;
                }, 5000);

                this.discount = response.data.amount;

                this.calculateCartTotalAmount();

                this.discountCodeInput = '';
            }).catch(error => {
                this.errorCoupon = error.response.data.message;

                this.discount = 0;

                this.calculateCartTotalAmount();
            })
            .finally(() => {
                this.loading = false;
            });
        },
    },
}
</script>