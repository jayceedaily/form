import {base} from './base'


export const form = {

    namespaced: true,

    state: {
        ...base.state,

        endpoint: '/form',
    },

    mutations: {
        ...base.mutations,

        removeQuestion: (state, question) => {

            let index = state.selected.questions.findIndex( list_item => list_item.id == question.id );

           if(index !== false) {

                state.selected.questions.splice(index, 1);
           }
        }

    },

    actions: {
        ...base.actions,

        addQuestion: async({commit, state}, data) => {
            let response = await http.post(state.endpoint + '/'+state.selected.id + '/question', data);

            return response;
        },

        removeQuestion: ({commit}, question)=> {

            commit('removeQuestion', question);
        }


    },

    getters: {
        ...base.getters,

    }

}
