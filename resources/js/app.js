require('./bootstrap');

import Vue from 'vue'
// import * as VeeValidate from 'vee-validate';

// import { ValidationProvider } from 'vee-validate';
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
// Vue.component('ValidationProvider', ValidationProvider);


import VueRouter from 'vue-router'
Vue.use(VueRouter )
import routes from './routes'

import App from './components/App.vue'

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes)
})
