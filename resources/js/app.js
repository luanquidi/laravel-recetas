require('./bootstrap');

window.Vue = require('vue');

Vue.config.ignoredElements = ['trix-editor'];
Vue.component('date-recipe', require('./components/DateRecipe.vue').default);


const app = new Vue({
    el: '#app',
});
