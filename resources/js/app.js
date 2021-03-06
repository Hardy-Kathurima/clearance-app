/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import vuetify from "../plugins/vuetify"
import router from "./router"
import VueAxios from 'vue-axios';
import axios from 'axios';
import moment from 'moment';
import store from './store'

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('MM-DD-YYYY  hh:mm ')
    }
});

Vue.use(VueAxios, axios);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-container', require('./components/appContainer.vue').default);
Vue.component('admin-container', require('./components/adminContainer.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$username = document.querySelector("meta[name='username']").getAttribute('content');
Vue.prototype.$hasApplied = document.querySelector("meta[name='hasApplied']").getAttribute('content');
Vue.prototype.$email = document.querySelector("meta[name='email']").getAttribute('content');
Vue.prototype.$role = document.querySelector("meta[name='role']").getAttribute('content');
Vue.prototype.$userID = document.querySelector("meta[name='userID']").getAttribute('content');


const app = new Vue({
    vuetify: vuetify,
    router,
    store,
    el: '#app',
});


