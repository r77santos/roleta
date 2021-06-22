app = require('../app');
require('../utils/functions');
require('../utils/bootstrap');
// require('bootstrap/js/dist/carousel');
// require('../utils/fadescroll');

app.$vuemount(window.Vue, [
    {
        component: 'vue-index',
        path: './components/index/App'
    },
]);

new Vue({
    el: '#app'
});

$(window).on('load', () => {
    $('img').alt();
    $('img.logo').logo();
});