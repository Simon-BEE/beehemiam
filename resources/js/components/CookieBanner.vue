<template>
    <transition name="fade">
        <div class="fixed z-20 bottom-0 left-0 bg-primary-700 bg-opacity-75 p-4 text-sm w-full flex justify-center items-center" v-if="showBanner">
            <slot></slot>

            <button class="absolute px-2 py-1 text-lg rounded right-1 top-1 hover:bg-primary-400 focus:outline-none" @click="closeAndSave">
                &times;
            </button>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            showBanner: false,
        }
    },

    mounted() {
        if (this.$cookies.isKey('beehemiamCookieBanner')) {
            return;
        }

        this.showBanner = true;
    },

    methods: {
        closeAndSave() {
            this.showBanner = false;

            this.$cookies.set('beehemiamCookieBanner', 'read', '30d');
        },
    },
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
     opacity: 0;
}
</style>
