require('./bootstrap');

import Vue from 'vue'

// Main pages
import App from './views/app.vue'


const app = new Vue({
    el: '#app',
    components: { App }
});

// require('./bootstrap');

// import Vue from 'vue'
// import router from './routes'

// //Main pages
// import App from './views/Library.vue'

// window.Vue = require('vue');
// Vue.use(VueRouter);


// window._ = require('lodash');

// axios.defaults.baseURL = 'http://localhost:'+window.location.port+'/';

// const app = new Vue({
//     el: '#app',
//     // router,
//     components: { App }
// });



