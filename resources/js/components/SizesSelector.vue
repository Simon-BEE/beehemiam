<template>
  <div class="mt-4 flex items-center space-x-3">
    <button
      type="button"
      v-for="size in sizes"
      class="p-4 rounded font-bold transition-colors duration-300 focus:outline-none hover:bg-primary-500"
      :class="
        size.id === newSelectedSize.id ? 'bg-primary-500' : 'bg-primary-200'
      "
      :key="size.id"
      @click="selectNewSize(size)"
    >
      {{ size.size.name }}
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

  mounted() {
    console.log(this.sizes, this.selectedSize);
    document.cookie = 'cookie1=test; expires=Sun, 1 Jan 2023 00:00:00 UTC; path=/'
  },

  methods: {
    selectNewSize(size) {
      this.newSelectedSize = size;
    },
  },
};
</script>