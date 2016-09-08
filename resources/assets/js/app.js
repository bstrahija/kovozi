
/**
 * Also we need some vendor scripts
 */
require('sweetalert/dist/sweetalert.min.js');
require('alertify-webpack/dist/alertify.js');

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example',   require('./components/Example.vue'));
Vue.component('home',      require('./components/Home.vue'));
Vue.component('this-week', require('./components/ThisWeek.vue'));
Vue.component('next-week', require('./components/NextWeek.vue'));
Vue.component('history',   require('./components/History.vue'));
Vue.component('schedule',  require('./components/Schedule.vue'));

const app = new Vue({
    el: 'body'
});
