require('./bootstrap');
import Vue from 'vue/dist/vue.esm.js'
//window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';

import App from './App.vue';

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.config.productionTip = false;

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
