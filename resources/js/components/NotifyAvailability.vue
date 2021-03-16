<template>
    <!-- <open-modal-button
        classes="modal-button mt-4 p-5 rounded-lg bg-primary-100 inline-flex items-center text-primary-500 transition-colors duration-200 hover:bg-primary-500 hover:text-white"
        title="Être notifié lors de la disponibilité du produit"
        route=""
        modal-name=".modalAvailability"
        @click.native="submitForm"
    >
        <svg viewBox="0 0 24 24" class="w-4 h-4 mr-2">
        <path
          fill="currentColor"
          d="M10.07,14.27C10.57,14.03 11.16,14.25 11.4,14.75L13.7,19.74L15.5,18.89L13.19,13.91C12.95,13.41 13.17,12.81 13.67,12.58L13.95,12.5L16.25,12.05L8,5.12V15.9L9.82,14.43L10.07,14.27M13.64,21.97C13.14,22.21 12.54,22 12.31,21.5L10.13,16.76L7.62,18.78C7.45,18.92 7.24,19 7,19A1,1 0 0,1 6,18V3A1,1 0 0,1 7,2C7.24,2 7.47,2.09 7.64,2.23L7.65,2.22L19.14,11.86C19.57,12.22 19.62,12.85 19.27,13.27C19.12,13.45 18.91,13.57 18.7,13.61L15.54,14.23L17.74,18.96C18,19.46 17.76,20.05 17.26,20.28L13.64,21.97Z"
        ></path>
      </svg>
      Je veux être averti lorsque le vêtement sera en vente
    </open-modal-button> -->
    <div class="text-red-500 uppercase text-9xl">OLD</div>
</template>

<script>
import OpenModalButton from './OpenModalButton';

export default {
  components: { OpenModalButton },

  props: {
    productOption: {
      required: true,
      type: Object,
    },
  },

  methods: {
      submitForm() {
          console.log('ee')
      },

  },
};
</script>
