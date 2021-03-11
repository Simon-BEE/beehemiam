<template>
    <div class="w-full">
        <button type="button" class="text-lg font-bold mx-auto flex items-center justify-center rounded p-4 transition-colors duration-200 bg-primary-700 hover:bg-primary-400 focus:outline-none" @click="collapse">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                <path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" />
            </svg>
            Via carte bancaire
        </button>

        <transition name="collapse">
            <article class="card-payment w-full bg-primary-100 p-4 rounded mt-2" v-show="isOpen">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus sit quos sed aperiam ratione odit vitae! Quisquam provident placeat sapiente sit nesciunt eius id eveniet deleniti magnam? Dolores, atque ullam.
            </article>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: false,
            stripe: null,
        }
    },

    mounted() {
        this.stripe = window.Stripe('pk_test_51ITkJ4HQGTdB5i42cvWjnkNgJzRV3gd4yKIdGicQQ8w9VbcqDoX2XO40Xcxqi2VaKWT3vsR6rmIPt261vgIgYJEf001J73957U');
    },

    methods: {
        collapse() {
            this.isOpen = !this.isOpen;
        },
    }
}
</script>

<style scoped>
    .collapse-enter-active, .collapse-leave-active {
        transition: all .2s;
        max-height: auto;
    }
    .collapse-enter, .collapse-leave-to {
        max-height: 0;
        opacity: 0;
    }
</style>
