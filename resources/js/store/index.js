import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import {auth} from './auth';
import {form} from './form';

export const store = new Vuex.Store({modules: {
    auth,
    form,
}})
