<template>
  <div class="">
    <vue-easy-lightbox
        :visible="visible"
        :imgs="images"
        :index="index"
        :moveDisabled="true"
        @hide="handleHide"
    >
        <template v-slot:toolbar="{ toolbarMethods }" class="toolbar">
            <div class="toolbar">
                <button type="button" @click="toolbarMethods.zoomIn" class="toolbar-btn">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                </button> 
                <button type="button" @click="toolbarMethods.zoomOut" class="toolbar-btn">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path>
                    </svg>
                </button> 
            </div>
        </template>
    </vue-easy-lightbox>
    
    <!-- Main image -->
    <article class="w-full">
        <figure class="relative cursor-pointer group" @click="show()">
            <img :src="thumbs[0]" :alt="productName" class="rounded w-full object-cover">
            <figcaption class="absolute w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center rounded">
                <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                </svg>
            </figcaption>
        </figure>
    </article>
    <!-- Other -->
    <article class="grid grid-cols-2 lg:grid-cols-3 gap-3.5 w-full justify-between mt-4" v-if="thumbs.length > 1">
        <figure class="relative cursor-pointer group" v-for="(image, index) in thumbs.slice(1)" :key="index" @click="show(index + 1)">
            <img :src="image" :alt="productName" class="shadow-lg w-full h-40 object-cover rounded">
            <figcaption class="absolute rounded w-full h-full bg-black bg-opacity-0 inset-0 transition-all duration-300 group-hover:bg-opacity-50 flex items-center justify-center">
                <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-7 h-7 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14M12,10H10V12H9V10H7V9H9V7H10V9H12V10Z" />
                </svg>
            </figcaption>
        </figure>
    </article>

  </div>
</template>

<script>
import VueEasyLightbox from 'vue-easy-lightbox';

export default {
    components: { VueEasyLightbox },

    props: {
        productName: {
            required: true,
            type: String,
        },
        productImages: {
            required: true,
            type: Array,
        },
        productThumbs: {
            required: true,
            type: Array,
        },
    },

    data() {
        return {
            visible: false,
            index: 0,
            images: this.productImages,
            thumbs: this.productThumbs,
        }
    },

    methods: {
        show(imgIndex = 0) {
            this.index = imgIndex;
            this.visible = true
        },

        handleHide() {
            this.visible = false
        },

    }
}
</script>

<style>
    img.vel-img {
        border-radius: .25rem;
    }
</style>

<style scoped>

    .toolbar {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        position: absolute;
        overflow: hidden;
        bottom: 8px;
        left: 50%;
        -webkit-transform: translate(-50%);
        transform: translate(-50%);
        opacity: .9;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        background-color: #2d2d2d;
        border-radius: 4px;
        padding: 0;
    }

    .toolbar-btn {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        cursor: pointer;
        padding: 6px 10px;
        font-size: 20px;
        color: #fff;
        background-color: #2d2d2d;
        -webkit-tap-highlight-color: transparent;
        outline: 0;
        transition: background-color 200ms linear;
    }

    .toolbar-btn:hover {
        background-color: #444;
    }
</style>