window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')['content'];
axios.defaults.baseURL = 'http://beehemiam.test/api/';

window.base_url = 'http://beehemiam.test';
