<template>
  <div class="mt-4 flex flex-wrap items-center">
    <button
      type="button"
      v-for="size in sizes"
      class="p-3 md:p-4 rounded font-bold transition-colors duration-300 focus:outline-none hover:bg-primary-500 mr-2 mb-2"
      :class="
        size.id === newSelectedSize.id ? 'bg-primary-500' : 'bg-primary-200'
      "
      :key="size.id"
      @click="selectNewSize(size)"
    >
      {{ size.size ? size.size.name : size.name }}
    </button>
    <input type="hidden" name="size_id" :value="newSelectedSize.id" />
  </div>
</template>

<script>
export default {
  props: {
    sizes: {
      required: true,
      type: Array,
    },
    selectedSize: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      newSelectedSize: this.selectedSize,
    };
  },

  methods: {
    selectNewSize(size) {
      this.newSelectedSize = size;
    },
  },
};
</script>