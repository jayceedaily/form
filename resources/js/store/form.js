import {base} from './base'


export const form = {

    namespaced: true,

    state: {
        ...base.state,

        endpoint: '/form',

        sheets: [],

        key: 'uuid',
    },

    mutations: {
        ...base.mutations,

        removeQuestion: (state, question) => {

            let index = state.selected.questions.findIndex( list_item => list_item.id == question.id );

           if(index !== false) {

                state.selected.questions.splice(index, 1);
           }
        },

        loadSheets: (state, responses) => {
            state.responses = responses;
        }
    },

    actions: {
        ...base.actions,

        loadSheets: async({commit, state}) => {
            let response = await http.get(state.endpoint + '/' + state.selected[state.key] + '/sheet');

            if(response.status == 200) {

            }

            return response;
        },

        addQuestion: async({commit, state}, data) => {
            let response = await http.post(state.endpoint + '/'+state.selected[state.key] + '/question', data);

            return response;
        },

        removeQuestion: ({commit}, question)=> {

            commit('removeQuestion', question);
        },

        downloadResponse: async ({commit, state}) => {
            let response = await http.download(state.endpoint + '/'+state.selected[state.key] + '/download');

            return response;
        }
    },

    getters: {
        ...base.getters,

        sheets: (state) => {
            return state.sheets;
        }
    }
}
