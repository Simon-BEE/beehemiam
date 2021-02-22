<template>
    <button class="popover-button hidden md:flex p-2 transition-colors duration-200 rounded hover:bg-primary-400 hover:bg-opacity-25 focus:outline-none"
        :title="title"
        @click="popover"
    >
        <svg class="w-6 h-6" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" />
        </svg>
    </button>
</template>

<script>
export default {
    props: {
        title: {
            required: true,
            type: String,
        },
    },

    methods: {
        popover(e) {;
            this.togglePopover(e.currentTarget.parentNode.querySelector('.popover-menu'));
            this.toggleOverlay();
        },
    },
}
</script>