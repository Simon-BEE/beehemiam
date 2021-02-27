<template>
    <button type="button" 
        :class="classes" 
        :title="title"
        @click="openModal"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        title: {
            required: true,
            type: String,
        },

        classes: {
            required: true,
            type: String,
        },

        route: {
            type: String,
            default: null,
        },

        modalName: {
            type: String,
            default: null,
        },
    },

    methods: {
        openModal() {
            if (this.route) {
                document.querySelector('.modal-form').action = this.route;
            }

            this.toggleModal(document.querySelector(this.modalName ?? '.modal-content'));

            this.toggleOverlay(true)
        },
    },
}
</script>