import {base} from './base'


export const form = {

    namespaced: true,

    state: {
        ...base.state,

        endpoint: '/form',
    },

    mutations: {
        ...base.mutations,

    },

    actions: {
        ...base.actions,


    },

    getters: {
        ...base.getters,

    }

}
