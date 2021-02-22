<template>
    <div class="clickable-overlay hidden h-screen w-screen fixed inset-0" @click="close"></div>
</template>

<script>
export default {
    methods: {
        close(e) {
            document.querySelectorAll('.popover-menu').forEach(menu => {
                if (!menu.classList.contains('md:opacity-0')) {
                    this.togglePopover(menu);
                }
            });
            document.querySelectorAll('.modal-content:not(.opacity-0)').forEach(modal => {
                this.toggleModal(modal);
            });
            this.toggleOverlay();
        },
    },
}
</script>