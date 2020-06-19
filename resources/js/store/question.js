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

        addOption: async ({commit,state}, data) => {
            let response = await http.store(state.endpoint + '/' + state.selected.id + '/option', data);

            return response;
        },

    },

    getters: {
        ...base.getters,

    }

}
