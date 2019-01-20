import Vue from 'vue'
import Router from 'vue-router'

Vue.use( Router );

import EntryPoint from '../js/components/EntryPoint.vue'

export default new Router ({
    model: 'history',
    routes: [
        {
            path: '/',
            name: 'entryPoint',
            component: EntryPoint
        }
    ]
})