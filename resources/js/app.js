require('./bootstrap');

import 'owl.carousel';

window.Vue = require('vue');

Vue.config.ignoredElements = ['trix-editor'];
Vue.component('date-recipe', require('./components/DateRecipe.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);


const app = new Vue({
    el: '#app',
});


// Carrousel on OWL
jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0 : {
                items:1
            },
            600: {
                items: 2
            },
            1000 : {
                items: 3
            }
        }
    });
});