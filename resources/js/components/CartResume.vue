<template>
    <section class="bg-primary-200 p-4 rounded flex flex-col space-y-4">
        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Vous avez un code promo ?</h4>

            <div class="flex items-center">
                <div class="w-full mb-4">
                    <input 
                        type="text" name="discount" id="discount" 
                        placeholder="Code promo" value="" required="required" 
                        class="w-full mt-2 px-4 py-2 block rounded text-kaki-900 border border-transparent focus:bg-white focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500 bg-primary-100"
                    >
                </div>
                <button type="button" class="rounded p-2 transition-colors duration-200 inline-flex items-center justify-center bg-primary-500 text-white  hover:bg-primary-400 font-semibold -mt-2 ml-2">
                    Ajouter
                </button>
            </div>
        </article>
        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Montant total de la commande</h4>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Sous-total</p>
                <p class="text-lg font-semibold">{{ subTotal }}€</p>
            </div>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Frais de livraison</p>
                <p class="text-lg font-semibold">{{ shippingFees }}€</p>
            </div>
            <div class="flex items-center justify-between bg-primary-100 px-2 py-1 rounded" v-if="discount !== 0 && discountCode">
                <p>Code promo <span class="font-bold">{{ discountCode }}</span></p>
                <p class="text-lg font-semibold">-{{ discount }}€</p>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-primary-400 px-2 py-1">
                <p>Montant total</p>
                <p class="text-lg font-semibold">{{ total }}€</p>
            </div>
        </article>
    </section>
</template>

<script>
export default {
    props: {
        cartSubTotal: {
            required: true,
            type: Number,
        },
    },

    data() {
        return {
            subTotal: this.cartSubTotal,
            shippingFees: 5,
            total: 0,
            discount: 0,
            discountCode: null,
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
        },
    },
}
</script>