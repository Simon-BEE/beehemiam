<template>
    <button class="p-8 inline-flex items-center font-semibold text-2xl transition-colors duration-300 hover:bg-primary-300" @click.prevent="addToCart">
        <svg class="w-7 h-7 mr-3" viewBox="0 0 24 24">
            <path fill="currentColor" d="M20 15V18H23V20H20V23H18V20H15V18H18V15H20M12 13C10.9 13 10 13.9 10 15S10.9 17 12 17 14 16.1 14 15 13.1 13 12 13M13.35 21H5.5C4.58 21 3.81 20.38 3.58 19.54L1.04 10.27C1 10.18 1 10.09 1 10C1 9.45 1.45 9 2 9H6.79L11.17 2.45C11.36 2.16 11.68 2 12 2S12.64 2.16 12.83 2.44L17.21 9H22C22.55 9 23 9.45 23 10L22.97 10.27L22 13.81C21.43 13.5 20.79 13.24 20.12 13.11L20.7 11H3.31L5.5 19H13C13 19.7 13.13 20.37 13.35 21M9.2 9H14.8L12 4.8L9.2 9Z" />
        </svg>
        Ajouter au panier
    </button>
</template>

<script>
export default {
    props: {
        productOption: {
            type: Object
        },
    },

    mounted() {
        console.log(this.productOption);
    },

    methods: {
        addToCart(e) {
            let selectedSize = document.getElementById('addCartForm').querySelector('input[name="size_id"]').value;

            let cartItems = [];
            if(localStorage.getItem('cart')){
                cartItems = JSON.parse(localStorage.getItem('cart'));
            }
            cartItems.push({'productOptionSizeId' : selectedSize});

            cartItems = [...new Map(cartItems.map(item => [item['productOptionSizeId'], item])).values()];

            localStorage.setItem('cart', JSON.stringify(cartItems));

            // ! IMPORTANT
            window.dispatchEvent(new CustomEvent('new-product-added-to-', {
                detail: {
                    storage: localStorage.getItem('cart')
                }
            }));

            e.currentTarget.innerHTML = "Produit ajouté au panier";
        },
    },
}
</script>