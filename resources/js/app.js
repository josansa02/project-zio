/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Swal = require('sweetalert2'); 

window.Vue = require('vue').default;

/* Ruta de los componentes */
Vue.component('like-component', require('./components/LikeComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('imagenform-component', require('./components/ImagenFormComponent.vue').default);
Vue.component('peticionform-component', require('./components/PeticionFormComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
