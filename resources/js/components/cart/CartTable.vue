<template>
    <table class="w-full whitespace-nowrap">
        <thead>
            <tr class="border-b-2 border-primary-300">
                <th class="hidden md:table-cell p-4"></th>
                <th class="p-4"></th>
                <th class="p-4">Prix</th>
                <th class="p-4">Quantité</th>
                <th class="p-4">Sous-total</th>
                <th class="p-4"></th>
            </tr>
        </thead>
        <tbody>
            <tr class="" v-if="loading">
                <td colspan="6" class="text-center">
                    <loader />
                </td>
            </tr>
            <tr v-for="product in products" :key="product.id" v-else-if="products.length && !loading" class="transition-colors duration-500 hover:bg-gray-100">
                <td class="hidden md:table-cell px-2 py-6 md:w-1/6">
                    <a :href="product.product_option.path">
                        <img :src="product.product_option.images[0].path" :alt="product.product_option.name + ' image'" class="w-24 h-24 object-cover rounded">
                    </a>
                </td>
                <td class="px-2 py-6 md:w-1/2">
                    <a :href="product.product_option.path">
                        <h3 class="mb-1">
                            <span class="font-bold text-xl">{{ product.product_option.name }}</span>
                            <span class="text-xs uppercase ml-2" v-if="product.is_preorder">(précommande)</span>
                        </h3>
                        <p class="inline text-sm uppercase font-semibold px-2 py-1 rounded-full bg-primary-200">Taille {{ product.size.name }}</p>
                    </a>
                </td>
                <td class="px-2 py-6 text-center font-semibold">
                    {{ product.product_option.formatted_price }}€
                </td>
                <td class="px-2 py-6 text-center">
                    <input
                        class="border border-primary-200 rounded focus:outline-none focus:border-transparent focus:ring-2 focus:ring-primary-500"
                        type="number" name="quantity" id="quantity" v-model="product.cart_quantity" step="1" min="1" max="10"
                        @change="updateQuantity(product)"
                    >
                </td>
                <td class="px-2 py-6 text-center font-semibold">
                    {{ product.product_option.formatted_price * product.cart_quantity }}€
                </td>
                <td>
                    <button @click="removeProduct(product)" class="flex justify-center text-red-400 hover:bg-primary-700 rounded p-1" title="Supprimer du panier">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" />
                        </svg>
                    </button>
                </td>
            </tr>
            <tr class="" v-else>
                <td colspan="6" class="text-center py-8">
                    Votre panier est vide !
                </td>
            </tr>
        </tbody>

    </table>
</template>

<script>
import Loader from '../LoaderIcon';

export default {
    components: { Loader },

    props: {
        productOptions: {
            required: true,
            type: Array,
        },
    },

    data() {
        return {
            products: this.productOptions,
            loading: false,
        }
    },

    methods: {
        updateQuantity(product) {
            if (!product.id) {
                this.updatePreOrderQuantity(product);
                return;
            }

            if (product.cart_quantity < 1) {
                let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));
                cartItems = cartItems.filter(cartItem => cartItem.productOptionSizeId != product.id);
                this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

                this.products = this.products.filter(productOption => productOption.id != product.id);
                product.cart_quantity = 0;
            }

            if (product.cart_quantity > 10) {
                product.cart_quantity = 10;
            }

            axios.patch('/cart/update/sizes/' + product.id,
                {quantity: product.cart_quantity},
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }).then(response => {
                console.info(response.data.message);

                window.dispatchEvent(new CustomEvent('cart-amount-change', {
                    detail: {
                        storage: this.products.reduce(function (acc, current) {
                            return acc + (current.cart_quantity * current.product_option.formatted_price);
                        }, 0),
                    }
                }));

                if (!this.products.length) {
                    window.location.reload();
                }
            }).catch(error => {
                if (error.response.data.message == "Plus de stock disponible") {
                    this.callAlert("Stock insuffisant.", "error")
                }

                console.error(error.response.data.message);
            });
        },

        removeProduct(product) {
            if (!product.id) {
                this.removePreOrderProduct(product);
                return;
            }

            let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));
            cartItems = cartItems.filter(cartItem => cartItem.productOptionSizeId != product.id);
            this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

            axios.delete('/cart/delete/sizes/' + product.id,
                null,
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }).then(response => {
                console.info(response.data.message);
                this.products = this.products.filter(productOption => productOption.id != product.id);

                this.callAlert('Vêtement retiré du panier');

                window.dispatchEvent(new CustomEvent('cart-amount-change', {
                    detail: {
                        storage: this.products.reduce(function (acc, current) {
                            return acc + (current.cart_quantity * current.product_option.formatted_price);
                        }, 0),
                    }
                }));
            }).catch(error => console.error(error))
            .finally(() => {
                if (!this.products.length) {
                    window.location.reload();
                }
            });
        },

        updatePreOrderQuantity(product) {
            if (product.cart_quantity < 1) {
                let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));

                cartItems = cartItems.filter(cartItem => {
                    return (cartItem.preOrderStockId.sizeId != product.size.id || cartItem.preOrderStockId.productOptionId != product.product_option.id)
                });

                this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

                this.products = this.products.filter(productOption => {
                    return (productOption.size.id != product.size.id || productOption.product_option.id != product.product_option.id)
                });
                product.cart_quantity = 0;
            }

            axios.patch('/cart/update/preorder',
                {
                    quantity: product.cart_quantity,
                    product_option_id: product.product_option.id,
                    size_id: product.size.id,
                },
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')['content']
                    }
                }).then(response => {
                console.info(response.data.message);

                window.dispatchEvent(new CustomEvent('cart-amount-change', {
                    detail: {
                        storage: this.products.reduce(function (acc, current) {
                            return acc + (current.cart_quantity * current.product_option.formatted_price);
                        }, 0),
                    }
                }));

                if (!this.products.length) {
                    window.location.reload();
                }
            }).catch(error => {
                if (error.response.data.message == "Plus de stock disponible") {
                    this.callAlert("Stock insuffisant.", "error")
                }

                console.error(error.response.data.message);
            });
        },

        removePreOrderProduct(product) {
            let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));

            cartItems = cartItems.filter(cartItem => {
                if (cartItem.preOrderStockId) {
                    return (cartItem.preOrderStockId.sizeId != product.size.id || cartItem.preOrderStockId.productOptionId != product.product_option.id)
                } else {
                    return cartItem;
                }
            });

            this.$cookies.set('beehemiamCart', JSON.stringify(cartItems));

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

                this.callAlert('Vêtement retiré du panier');

                this.products = this.products.filter(productOption => {
                    return (productOption.size.id != product.size.id || productOption.product_option.id != product.product_option.id)
                });

                window.dispatchEvent(new CustomEvent('cart-amount-change', {
                    detail: {
                        storage: this.products.reduce(function (acc, current) {
                            return acc + (current.cart_quantity * current.product_option.formatted_price);
                        }, 0),
                    }
                }));
            }).catch(error => console.error(error))
            .finally(() => {
                if (!this.products.length) {
                    window.location.reload();
                }
            });
        },


    },
}
</script>
