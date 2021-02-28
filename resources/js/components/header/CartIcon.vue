<template>
    <span class="flex items-center">
        <svg class="w-6 h-6 mr-3 md:mr-0" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M22 9H17.21L12.83 2.44C12.64 2.16 12.32 2 12 2S11.36 2.16 11.17 2.45L6.79 9H2C1.45 9 1 9.45 1 10C1 10.09 1 10.18 1.04 10.27L3.58 19.54C3.81 20.38 4.58 21 5.5 21H18.5C19.42 21 20.19 20.38 20.43 19.54L22.97 10.27L23 10C23 9.45 22.55 9 22 9M12 4.8L14.8 9H9.2L12 4.8M18.5 19L5.5 19L3.31 11H20.7L18.5 19M12 13C10.9 13 10 13.9 10 15S10.9 17 12 17 14 16.1 14 15 13.1 13 12 13Z" />
        </svg>
        <span class="md:hidden">Mon panier</span>
        <span
            class="absolute -top-0.5 -right-0.5 bg-primary-600 text-white py-0.5 px-1 rounded-full text-xs" v-if="numberProductsInCart">
            {{ numberProductsInCart }}
        </span>
    </span>
</template>

<script>
export default {
    data() {
        return {
            items: null,
            numberProductsInCart: null,
        }
    },

    mounted() {
        let cartItems = JSON.parse(this.$cookies.get('beehemiamCart'));
        this.numberProductsInCart = cartItems ? cartItems.length : null;

        window.addEventListener('cart-change-event', (event) => {
            this.numberProductsInCart = event.detail.storage;
        });
    },
}
</script>