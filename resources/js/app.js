require('./bootstrap');

import Vue from 'vue';
import mixins from './mixins';
Vue.use(require('vue-cookies'))

import ResponsiveButton from './components/header/ResponsiveButton';
import AuthButton from './components/header/AuthButton';
import OpenModalButton from './components/OpenModalButton';
import CloseModalButton from './components/CloseModalButton';
import OverlayBackground from './components/OverlayBackground';
import SizesSelector from './components/SizesSelector';
import AddCart from './components/AddCart';
import CartIcon from './components/header/CartIcon';
import CartTable from './components/CartTable';
import LoaderIcon from './components/LoaderIcon';

Vue.mixin(mixins);

new Vue({
  el: '#app',

  components: {
    SizesSelector, ResponsiveButton, AuthButton, 
    OpenModalButton, OverlayBackground, CloseModalButton,
    AddCart, CartIcon, CartTable, LoaderIcon,
  },
});