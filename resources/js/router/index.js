import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';


Vue.use(VueRouter);

export const router = new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: 'is-active',
    beforeRouteUpdate (to, from, next) {
        let PID = to.query.pid
        console.log('here');
        next()
      }
});


