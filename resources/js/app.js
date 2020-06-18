import Vue          from 'vue';
import Axios        from 'axios';

import App          from './view/App';

import {router}     from './router';
import {store}      from './store';
import {request}    from './services';
import {http}       from './services';


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.request  = request;
window.http     = http;
window.axios    = Axios;


const app = new Vue({
    el: '#app',
    comments: {App},
    store,
    router
});