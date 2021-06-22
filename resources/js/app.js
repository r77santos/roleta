window.Vue = require('vue');

window.axios = require('axios');

window.swal = require('sweetalert');

window.jQuery = window.$ = require('jquery');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

module.exports.$vuemount = (vue, components) => {
    components.forEach((element) => {
        let { component, path } = element;
        vue.component(`${component}`, require(`${path}.vue`).default);
    });
}
