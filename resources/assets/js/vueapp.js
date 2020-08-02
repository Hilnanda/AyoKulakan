/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import 'vue-select/dist/vue-select.css';
import '../css/style.css';

require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';
import vSelect from 'vue-select';
import VueCurrencyFilter from 'vue-currency-filter';
import { asset } from '@codinglabs/laravel-asset';
import vmodal from 'vue-js-modal';
import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.config.productionTip = false;

Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm');
    }
});

Vue.filter('formatDateDetail', function (value) {
    if (value) {
        return moment(String(value)).format('DD MMMM YYYY hh:mm');
    }
});

// getFullCities(value) {
//     return this.cities.filter(e => e.indexOf("airport_code") == value);
//   }

Vue.mixin({
    methods: {
        asset: asset
    }
});

Vue.use(VueSweetalert2);

Vue.use(vmodal);

Vue.use(VueCurrencyFilter, {
    symbol: 'Rp',
    thousandsSeparator: '.',
    fractionCount: 2,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-select', vSelect)
Vue.component('booking-list', require('./components/Airline/BookingList.vue').default);
Vue.component('airline-component', require('./components/Airline/AirlineComponent.vue').default);
Vue.component('passenger-component', require('./components/Airline/PassengerComponent.vue').default);
Vue.component('datepicker', require('vuejs-datepicker'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#vueapp',
});
