import {base} from './base'


export const option = {

    namespaced: true,

    state: {
        ...base.state,

        endpoint: '/option',
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
