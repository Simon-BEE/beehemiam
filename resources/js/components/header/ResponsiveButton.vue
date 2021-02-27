<template>
    <button type="button" class="responsive-button flex md:hidden p-4 focus:outline-none" @click="toggleMenu()">
        <svg class="w-7 h-7 focus:outline-none" viewBox="0 0 24 24">
            <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
        </svg>
    </button>
</template>

<script>
export default {
    methods: {
        toggleMenu() {;
            document.querySelector('.responsive-menu').classList.toggle('hidden');
        },
    },
}
</script>