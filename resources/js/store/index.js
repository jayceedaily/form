import Vue from 'vue';
import Vuex from 'vuex';
import camelCase from 'lodash/camelCase';

const requireModule = require.context('.', false, /\.js$/)

Vue.use(Vuex);

const modules = {};

requireModule.keys().forEach(filename => {
    if(filename === './index.js') return

    let moduleName  = camelCase(filename.replace(/(\.\/|\.js)/g, ''));

    modules[moduleName] = requireModule(filename)[moduleName];
})

export const store = new Vuex.Store({modules})
