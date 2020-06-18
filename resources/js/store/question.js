import {base} from './base'


export const question = {

    namespaced: true,

    state: {
        ...base.state,

        endpoint: '/question',
    },

    mutations: {
        ...base.mutations,

    },

    actions: {
        ...base.actions,

        addOption: function() {

        }
    },

    getters: {
        ...base.getters,

    }

}
