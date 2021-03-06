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
    },

    methods: {
        close() {
            document.querySelectorAll('.modal-content:not(.opacity-0)').forEach(modal => {
                this.toggleModal(modal);
            })

            this.toggleOverlay(true)
        },
    },
}
</script>