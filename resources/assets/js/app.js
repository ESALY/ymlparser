
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(ElementUI);
Vue.use(VueRouter);

Vue.component('example', require('./components/Example.vue'));
Vue.component('parser-home', require('./components/ParserHome'));
import router from './router';

const app = new Vue( {
    el: '#app',
    router,
    data: function(){
        return{
            defaultActive:1,
            activeIndex: 1,
            products: [],
            window: {
                width: 0,
                height: 0
            },
            searchForm: {
                labelPosition: 'top',
                name: '',
                region: '',
                type: ''
            },
            hello: 'im vue',
        }
    },
    methods: {
        init: function () {
            this.getItems();
        },
        showProduct: function () {
            console.log(12);
        },
        getItems: function () {

            var name = '';

            if(this.searchForm.name !== undefined){
                name = this.searchForm.name;
            }

            axios.post('/items/get', {
                name: name
            })
                .then(function (response) {
                    console.log(response.data);
                    app.products = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },
        created() {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
            this.init();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        }
    },
    //render: h => h(app)
});