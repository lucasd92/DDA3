/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import VueGoogleCharts from 'vue-google-charts'
import VueMqtt from 'vue-mqtt'

Vue.use(VueGoogleCharts)
Vue.use(VueMqtt, 'ws://127.0.0.1:9001', {clientId: 'WebClient-' + parseInt(Math.random() * 100000)})

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Registro un componente vacío para poder usar como bus de comunicaciones entre componentes 
Vue.prototype.$bus = new Vue();

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('lista-disp', require('./components/ListaDisp.vue').default);
Vue.component('lista-disp-inac', require('./components/ListaDispInac.vue').default);
Vue.component('lista-log', require('./components/ListaLog.vue').default);
Vue.component('graficos', require('./components/Graficos.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
