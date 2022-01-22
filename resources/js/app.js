
require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'
import Vuetify from 'vuetify'
import router from './Router'
import User from './Helpers/User'
import Exception from './Helpers/Exception';
Vue.use(Vuetify)
window.User = User
Window.Exception = Exception
Vue.component('home', require('./components/Home.vue').default);
window.EventBus = new Vue()

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const vuetify = new Vuetify();

const app = new Vue({
    el: '#app',
    vuetify,
    router
});