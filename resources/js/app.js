require('./bootstrap');

// require('./front/alert');

import ResponsiveButton from './components/header/ResponsiveButton';
import AuthButton from './components/header/AuthButton';
import OpenModalButton from './components/OpenModalButton';
import CloseModalButton from './components/CloseModalButton';
import OverlayBackground from './components/OverlayBackground';
import SizesSelector from './components/SizesSelector';

import Vue from 'vue';

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
  }
});

new Vue({
  el: '#app',

  components: {
    SizesSelector, ResponsiveButton, AuthButton, 
    OpenModalButton, OverlayBackground, CloseModalButton,
  },
});