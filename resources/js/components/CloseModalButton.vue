<template>
    <button type="button" :class="classes" @click="close">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        classes: {
            required: true,
            type: String,
        },

        modalName: {
            type: String,
            default: null,
        },
    },

    methods: {
        close() {
            this.toggleModal(document.querySelector(this.modalName ?? '.modal-content'));

            this.toggleOverlay(true)
        },
    },
}
</script>