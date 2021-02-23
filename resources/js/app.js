require('./bootstrap');

import Vue from 'vue';

import ResponsiveButton from './components/header/ResponsiveButton';
import AuthButton from './components/header/AuthButton';
import OpenModalButton from './components/OpenModalButton';
import CloseModalButton from './components/CloseModalButton';
import OverlayBackground from './components/OverlayBackground';
import SizesSelector from './components/SizesSelector';
import AddCart from './components/AddCart';
import CartIcon from './components/header/CartIcon';

Vue.mixin({
  methods: {
    toggleOverlay(modal = false) {
      const overlay = document.querySelector('.clickable-overlay');

      overlay.classList.toggle('hidden');
      overlay.classList.toggle('z-20');
      if (modal) {
          overlay.classList.add('bg-black', 'bg-opacity-25');
      }else{
          overlay.classList.remove('bg-black', 'bg-opacity-25');
      }
    },

    togglePopover(popover) {
        popover.classList.toggle('md:opacity-0');
        popover.classList.toggle('-z-1');
        popover.classList.toggle('z-30');
    },

    toggleModal(modal) {
        modal.classList.toggle('opacity-0');
        modal.classList.toggle('-z-1');
        modal.classList.toggle('z-40');
    },

    addItemToCart(itemKey, itemValue) {
      let cartItems = [];
      if(localStorage.getItem('cart')){
          cartItems = JSON.parse(localStorage.getItem('cart'));
      }
      cartItems.push({itemKey : itemValue});

      cartItems = [...new Map(cartItems.map(item => [item[itemKey], item])).values()];

      localStorage.setItem('cart', JSON.stringify(cartItems));

      // ! IMPORTANT
      window.dispatchEvent(new CustomEvent('new-product-added-to-cart', {
          detail: {
              storage: localStorage.getItem('cart')
          }
      }));
    },
  }
});

new Vue({
  el: '#app',

  components: {
    SizesSelector, ResponsiveButton, AuthButton, 
    OpenModalButton, OverlayBackground, CloseModalButton,
    AddCart, CartIcon,
  },
});