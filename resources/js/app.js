require('./bootstrap');

require('./front/alert');
require('./front/modal');

import Vue from 'vue';
import SizesSelector from './components/SizesSelector';

// Vue.component('example-component', require('./components/SizesSelector.vue').default);

const app = new Vue({
  el: '#app',

  components: {
    SizesSelector,
  },
});


// Responsive menu click
try {
    document.querySelector('.responsive-button').addEventListener('click', () => {
        document.querySelector('.responsive-menu').classList.toggle('hidden')
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}
