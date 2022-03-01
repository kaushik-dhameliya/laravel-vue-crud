/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('directory', require('./components/Directory.vue').default);
// Vue.component('testing', require('./components/Testing.vue').default);

const app = new Vue({
    el: '#app',
});