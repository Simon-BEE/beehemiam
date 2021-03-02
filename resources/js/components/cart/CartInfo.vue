<template>
    <section class="bg-primary-200 p-4 rounded flex flex-col space-y-4">
        <div class="text-center" v-if="loading">
            <loader />
        </div>
        <article class="flex flex-col" v-else>
            <h4 class="font-bold text-lg mb-2">Votre panier</h4>

            <div 
                v-for="product in products"
                :key="product.id"
                class="flex flex-col my-3 bg-primary-100 p-2 rounded"
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
                    <button @click="removeProduct(product)" class="flex justify-center text-red-400 hover:bg-primary-300 rounded p-1" title="Supprimer du panier">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </article>

        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Livraison</h4>
            <p class="flex items-center">
                <svg class="mr-3 h-5 w-5" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z" />
                </svg>
                <span>
                    Livraison en <strong>{{ shippingFeesCountry }}</strong> par <strong>Colissimo</strong> - <strong>{{ shippingFeesAmount.toString().replace(/\./g, ',') }}€</strong>
                </span>
            </p>
        </article>

        <article class="flex flex-col space-y-2">
            <h4 class="font-bold text-lg">Montant total de la commande</h4>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Sous-total</p>
                <p class="text-lg font-semibold">{{ subTotal.toString().replace(/\./g, ',') }}€</p>
            </div>
            <div class="flex items-center justify-between px-2 py-1 rounded">
                <p>Frais de livraison</p>
                <p class="text-lg font-semibold">{{ shippingFeesAmount.toString().replace(/\./g, ',') }}€</p>
            </div>
            <div class="flex items-center justify-between bg-primary-100 px-2 py-1 rounded" v-if="discount !== 0 && discountCode">
                <p>Code promo <span class="font-bold">{{ discountCode }}</span></p>
                <p class="text-lg font-semibold">-{{ discount }}€</p>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-primary-400 px-2 py-1">
                <p>Montant total</p>
                <p class="text-lg font-semibold">{{ total.toString().replace(/\./g, ',') }}€</p>
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
    },

    data() {
        return {
            loading: false,
            products: this.cartItems,
            subTotal: this.cartSubTotal,
            shippingFeesAmount: 4.95,
            shippingFeesCountry: 'France',
            total: 0,
            discount: this.coupon ? this.coupon.amount : 0,
        }
    },
    watch: {
        subTotal() {
            this.calculateCartTotalAmount();
        },
    },
    
    mounted() {
        this.calculateCartTotalAmount();

        window.addEventListener('country-selected', (event) => {
            this.shippingFeesAmount = event.detail.storage === '1' 
                ? 4.95 
                : 12.90 ;
            this.shippingFeesCountry = event.detail.storage === '1' 
                ? 'France métropolitaine'
                : (event.detail.storage === '2' 
                    ? 'Belgique'
                    : 'Suisse' ) ;
            
            this.calculateCartTotalAmount();
        });
    },

    methods: {
        calculateCartTotalAmount() {
            this.total = (this.subTotal + this.shippingFeesAmount - this.discount).toFixed(2);
        },

        removeProduct(product) {
            if (!product.id) {
                this.removePreOrderProduct(product);
                return;
            }

            axios.delete('/cart/delete/sizes/' + product.id, 
                null, 
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }
            ).then(response => {
                console.info(response.data.message);

                this.products = this.products.filter(productOption => productOption.id != product.id);

                this.subTotal = this.products.reduce(function (acc, current) {
                    return acc + (current.cart_quantity * current.product_option.formatted_price);
                }, 0);

                this.calculateCartTotalAmount();

                let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));
                cartItems = cartItems.filter(cartItem => cartItem.productOptionSizeId != product.id);
                this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

                window.dispatchEvent(new CustomEvent('cart-change-event', {
                    detail: {
                        storage: cartItems.length,
                    }
                }));
            }).catch(error => console.error(error))
            .finally(() => {
                if (!this.products.length) {
                    window.location.href = '/panier';
                }
            });
        },

        removePreOrderProduct(product) {
            axios.patch('/cart/delete/preorder', 
                { 
                    product_option_id: product.product_option.id,
                    size_id: product.size.id,
                }, 
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }).then(response => {
                console.info(response.data.message);

                this.products = this.products.filter(productOption => {
                    return (productOption.size.id != product.size.id || productOption.product_option.id != product.product_option.id)
                });

                this.subTotal = this.products.reduce(function (acc, current) {
                    return acc + (current.cart_quantity * current.product_option.formatted_price);
                }, 0);

                this.calculateCartTotalAmount();

                let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));

                cartItems = cartItems.filter(cartItem => {
                    if (cartItem.preOrderStockId) {
                        return (cartItem.preOrderStockId.sizeId != product.size.id || cartItem.preOrderStockId.productOptionId != product.product_option.id)
                    } else {
                        return cartItem;
                    }
                });

                this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

                window.dispatchEvent(new CustomEvent('cart-change-event', {
                    detail: {
                        storage: cartItems.length,
                    }
                }));
            }).catch(error => console.error(error))
            .finally(() => {
                if (!this.products.length) {
                    window.location.href = '/panier';
                }
            });
        },
    },
}
</script>