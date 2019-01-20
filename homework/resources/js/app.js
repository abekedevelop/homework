import Vue from 'vue'
import router from '../router'
import App from './App.vue'
import store from '../store'

import M from 'materialize-css'

Vue.use(M);
new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
});
