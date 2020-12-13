require('./bootstrap');
window.Vue = require('vue');

import VeeValidate from 'vee-validate'
import vSelect from 'vue-select'

Vue.use(VeeValidate)
Vue.component('search-component', require('./components/search.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('auction-slots', require('./components/auction-slots.vue').default);
Vue.component('auction-slots-single', require('./components/single-auction-slots.vue').default);
Vue.component('v-select', vSelect);
Vue.component('product-card', require('./components/productCard.vue').default);
import moment from 'moment';
import VueCarousel from 'vue-carousel';


Vue.use(VueCarousel);
Vue.prototype.moment = moment
const app = new Vue({
        el: '#app',
        data() {
            return {
                message: 'This message from vue',
                form: {},
                regularHeader: true,
                serverTime: window.serverTime,
                user: {},
                termCheck: false,
            }
        },
        created() {

        },

        mounted() {


            var Swipes = new Swiper('.swiper-container', {
                slidesPerView: 5,
                loopedSlides: 1,
                centeredSlides: false,
                spaceBetween: 30,
                grabCursor: true,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                },


                breakpoints: {

                    1200: {
                        slidesPerView: 4,
                        loopedSlides: 4,
                        spaceBetween: 10
                    },

                    1024: {
                        slidesPerView: 3,
                        loopedSlides: 3,
                        spaceBetween: 10
                    },

                    768: {
                        slidesPerView: 2,
                        loopedSlides: 2,
                        spaceBetween: 10
                    },

                    425: {
                        slidesPerView: 1,
                        loopedSlides: 2,
                        spaceBetween: 20
                    },

                    375: {
                        slidesPerView: 1,
                        loopedSlides: 2,
                        spaceBetween: 20
                    },
                }

            });


        },

        created: function () {

            let currentUrl = window.location.pathname;

            if (currentUrl === '/' || currentUrl === '/about' || currentUrl === '/contact' || currentUrl === '/blog') {
                document.getElementById('categories').style.display = 'none';
            }

        },

        methods: {

            // allProducts() {
            //     document.getElementById("sidebar").classList.toggle('open');
            //     document.getElementById("mobileBox").style.display = 'block';
            // },

            openSidebar() {
                let sidebar = document.getElementById("sidebar");
                sidebar.classList.toggle('open');

                let mobileBox = document.getElementById("mobileBox");
                mobileBox.style.display = 'block';
            }
            ,

            closeSidebar() {
                let sidebar = document.getElementById("sidebar");
                let mobileBox = document.getElementById("mobileBox");
                sidebar.classList.remove('open');
                mobileBox.style.display = 'none';
            }

        },

    })
;
